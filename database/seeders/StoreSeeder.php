<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // store
        DB::table('stores')->delete();
        $stores = 
        [
            ['id'=>1,'name'=>'Nagia Store','slug'=>'Mobli Store1','description'=>'this store is Amazing One','logo_image'=>'d.jpg','cover_image'=>'d.jpg','status'=>'active'],
            ['id'=>2,'name'=>'Bakr Store','slug'=>'Mobli Store2','description'=>'this store is Amazing One','logo_image'=>'d.jpg','cover_image'=>'d.jpg','status'=>'active'],
            ['id'=>3,'name'=>'Fayroz Store','slug'=>'Mobli Store3','description'=>'this store is Amazing One','logo_image'=>'d.jpg','cover_image'=>'d.jpg','status'=>'active'],
        ];

        DB::table('stores')->insert($stores);
    }
}
