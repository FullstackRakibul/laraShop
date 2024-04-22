<?php

namespace App\Http\Controllers\editor;

use App\Order;
use App\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CourierController extends Controller
{
    private $pathao_client_secret = null;
    private $pathao_client_id = null;
    private $pathao_base_api = null;
    private $pathao_user_name = null;
    private $pathao_user_pass = null;

    public function __construct(){
        $this->pathao_client_secret = env('PATHAO_CLIENT_SECRET');
        $this->pathao_client_id     = env('PATHAO_CLIENT_ID');
        $this->pathao_base_api      = env('PATHAO_BASE_API');
        $this->pathao_user_name     = env('PATHAO_USER_NAME');
        $this->pathao_user_pass     = env('PATHAO_USER_PASS');
    }   

    /**
     * Get Pathao city
     */
    public function getPathaoCities( Request $request )
    {
        $response = Http::withHeaders($this->getHeaders())
                ->get($this->pathao_base_api . '/aladdin/api/v1/countries/1/city-list');

        return $response->body();
    }

    /**
     * Get pathao zone based on city
     */
    public function getPathaoZone( Request $request )
    {
        $response = Http::withHeaders($this->getHeaders())
        ->get($this->pathao_base_api . '/aladdin/api/v1/cities/'.$request->city_id.'/zone-list');

        return $response->body();
    }

    /**
     * Get pathao areas based on zone
     */
    public function getPathaoArea( Request $request )
    {
        $response = Http::withHeaders($this->getHeaders())
        ->get($this->pathao_base_api . '/aladdin/api/v1/zones/'.$request->zone_id.'/area-list');

        return $response->body();
    }

    /**
     * Get pahtao stores 
     */

     //get store
    public function getPathaoStores()
    {
        $response = Http::withHeaders( $this->getHeaders() )
                    ->get($this->pathao_base_api . '/aladdin/api/v1/stores');

       

        return $response->body();
    }

    /**
     * Create order in courier
     */

    public function createOrder( Request $request )
    {
        
        //validate 
        $validate = validator($request->all(),[
            'bulk'          => 'required'
        ]);

        if ( $validate->fails() ) {
            return [
                'status'  => 'error',
                'message' => 'Some required inputs are missing'
            ];
        }

        if ( is_array( $request->bulk ) ) {

            foreach ($request->bulk as $key => $id) {
                try {
                    //get order
                    $order = Order::where('orderIdPrimary',$id)->first();

                    //send order to courier
                    $this->sendToCourier($request,$order);
                } catch (\Exception $th) {
                    Toastr::error('message', $th->getMessage());
                }

            }
        }

        return [
            'status'  => 'success',
            'message' => 'Items send to courier'
        ];

    }

    /**
     * Send order to courier
     */

    private function sendToCourier( Request $request, Order $order )
    {

        $shippingInfo = Shipping::where('shippingPrimariId', $order->shippingId)->latest()->first(); 

        if ( ! $shippingInfo->courier ) {
            throw new \Exception("Courier info not set for $order->shippingId");
        }

        //check courier name
        switch ($shippingInfo->courier) {
            case 'pathao':
                $courier = (object) unserialize( $shippingInfo->courier_info );

                $payload = [
                    "store_id"           => (int) $courier->store,
                    "merchant_order_id"   => $order->shippingId,
                    "sender_name"         => Auth::user()->name,
                    "sender_phone"        => Auth::user()->phone,
                    "recipient_name"      => $shippingInfo->name,
                    "recipient_phone"     => $this->convertPhoneToEnglish( $shippingInfo->phone ),
                    "recipient_address"   => $shippingInfo->address,
                    "recipient_city"      => (int) $courier->city,
                    "recipient_zone"      => (int) $courier->zone,
                    "recipient_area"      => (int) $courier->area,
                    "delivery_type"       => (int) $courier->deliverytype,
                    "item_type"           => (int) $courier->itemtype,
                    "special_instruction" => $courier->specialnote,
                    "item_quantity"       => $order->orderDetails->productQuantity,
                    "item_weight"         => (float) $courier->weight,
                    "amount_to_collect"   => (int) $order->orderTotal,
                    "item_description"    => $order->orderDetails->productName,
                ];
                break;
            
        }
        
        try {
            $response = Http::withHeaders($this->getHeaders())
                    ->post($this->pathao_base_api . '/aladdin/api/v1/orders',$payload)->body();

            $data     = json_decode($response,true);


            if ( $data['type'] == 'success') {
                Toastr::success('message', $data['message'] . " for $order->shippingId");
            } else {
                $errors = $data['errors'] ?? false;

                if ( $errors ) {

                    $error_message = '';

                    foreach ( $errors as $input => $err ) {
                        $error_message .= "errors in " . ucfirst(str_replace('_',' ',$input));

                        foreach ($err as $key => $msg) {
                            $key += 1;
                            $error_message .= " $key . $msg ";
                        }

                    }

                  if ( $error_message != "" ) {
                      throw new \Exception("Error for $order->shippingId $error_message");
                  }
                }
            }
        } catch (\Exception $th) { 
            throw new \Exception( $th->getMessage() );
        }

      
    }

    private function getHeaders()
    {
        return [
            'Authorization' => 'Bearer '.$this->getPathaoAccessToken(),
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/josn'
        ];
    }

    private function getPathaoAccessToken()
    {

        $payload = [
            'client_id'     => $this->pathao_client_id,
            'client_secret' => $this->pathao_client_secret,
            'username'      => $this->pathao_user_name,
            'password'      => $this->pathao_user_pass,
            'grant_type'    => "password"
        ];


        $response = Http::withHeaders([
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/josn'
        ])->post($this->pathao_base_api . '/aladdin/api/v1/issue-token',$payload)->body();


        $token = json_decode($response);

        if ( $token ) {
            return $token->access_token ?? false;
        }

        return;
    }

    private function convertPhoneToEnglish( $number )
    {
        // Mapping array for Bangla to English digits
        $banglaDigits = array(
            '০' => '0',
            '১' => '1',
            '২' => '2',
            '৩' => '3',
            '৪' => '4',
            '৫' => '5',
            '৬' => '6',
            '৭' => '7',
            '৮' => '8',
            '৯' => '9'
        );

        // Convert Bangla digits to English digits
        $englishNum = strtr($number, $banglaDigits);

        return $englishNum;
    }

}
