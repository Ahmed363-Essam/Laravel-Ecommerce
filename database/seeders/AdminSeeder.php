<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        DB::table('admins')->delete();

        $admins = [
            ['id' => 1, 'name' => 'ahmed', 'username' => 'ahmed esssam', 'email' => 'ae676430@gmail.com', 'phone_number'=>'01062293101','password' => bcrypt('123456789')],
            ['id' => 2, 'name' => 'mohamed', 'username' => 'mohamed esssam', 'email' => 'mohamed@gmail.com','phone_number'=>'001062293101' ,'password' => bcrypt('123456789')],
        ];

        DB::table('admins')->insert($admins);

    }
}
