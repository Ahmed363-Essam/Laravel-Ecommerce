<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
             // producrts
             DB::table('products')->delete();
             $products = 
             [
                 ['id'=>1,'store_id'=>1,'cat_id'=>1, 'name'=>'wires', 'slug'=>'Wires','description'=>'this is wires','image'=>'d.jpg','price'=>2000,'status'=>'active','featured'=>rand(0,1),'rating'=>0],
                 ['id'=>2,'store_id'=>1,'cat_id'=>1, 'name'=>'lumbs','slug'=>'Wires2','description'=>'this is wires','image'=>'d.jpg','price'=>2000,'status'=>'active','featured'=>rand(0,1),'rating'=>1],
                 ['id'=>3,'store_id'=>1,'cat_id'=>1, 'name'=>'wires cu','slug'=>'Wires3','description'=>'this is wires','image'=>'d.jpg','price'=>2000,'status'=>'active','featured'=>rand(0,1),'rating'=>1],




                 ['id'=>4,'store_id'=>2,'cat_id'=>2, 'name'=>'t-shirts', 'slug'=>'v','description'=>'this is t-shirts','image'=>'d.jpg','price'=>2000,'status'=>'active','featured'=>rand(0,1),'rating'=>0],
                 ['id'=>5,'store_id'=>2,'cat_id'=>2, 'name'=>'trousers','slug'=>'trousers','description'=>'this is trousers','image'=>'d.jpg','price'=>2000,'status'=>'active','featured'=>rand(0,1),'rating'=>1],
                 ['id'=>6,'store_id'=>2,'cat_id'=>2, 'name'=>'shorts','slug'=>'shorts','description'=>'this is shorts','image'=>'d.jpg','price'=>2000,'status'=>'active','featured'=>rand(0,1),'rating'=>1],
             ];
     
             DB::table('products')->insert($products);
    }
}
