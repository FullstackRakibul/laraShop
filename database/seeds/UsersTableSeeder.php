<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        'role_id'=>'1',
        'name'=>'superadmin',
        'username'=>'User01',
        'email'=>'superadmin@websolutionit.com',
        'phone'=>'017',
        'status'=>'1',
        'designation'=>'CEO',
        'password'=>bcrypt('wsitsuperadmin$'),
        ]);

        DB::table('users')->insert([
        'role_id'=>'2',
        'name'=>'Admin',
        'username'=>'User02',
        'email'=>'admin@websolutionit.com',
        'phone'=>'019',
        'status'=>'1',
        'designation'=>'HR',
        'password'=>bcrypt('wsitadmin$'),
        ]);

        DB::table('users')->insert([
        'role_id'=>'3',
        'name'=>'Editor',
        'username'=>'User03',
        'email'=>'editor@websolutionit.com',
        'phone'=>'018',
        'status'=>'1',
        'designation'=>'GM',
        'password'=>bcrypt('wsiteditor$'),
        ]);

        DB::table('users')->insert([
        'role_id'=>'4',
        'name'=>'Author',
        'username'=>'User04',
        'email'=>'author@websolutionit.com',
        'phone'=>'015',
        'status'=>'1',
        'designation'=>'H.W',
        'password'=>bcrypt('wsitauthor$'),

        ]);
    }
}
