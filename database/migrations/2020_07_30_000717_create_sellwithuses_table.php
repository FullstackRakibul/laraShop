<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellwithusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellwithuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pName');
            $table->string('pCategory');
            $table->string('pPrice');
            $table->string('conpersonName');
            $table->string('conNumber');
            $table->text('address')->nullable();
            $table->text('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellwithuses');
    }
}
