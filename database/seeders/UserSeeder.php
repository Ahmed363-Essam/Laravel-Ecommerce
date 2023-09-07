<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->delete();
        $users = 
        [
            ['name'=>'ahmed essam','email'=>'ae676430@gmail.com','password'=> bcrypt('123456'),'phone_number'=>'01062293101'],
            ['name'=>'mohamed essam','email'=>'mohamed@gmail.com','password'=> bcrypt('123456'),'phone_number'=>'01006631236'],
            ['name'=>'salma essam','email'=>'salma@gmail.com','password'=> bcrypt('123456'),'phone_number'=>'01501501791'],
        ];

        DB::table('users')->insert($users);

    }
}
