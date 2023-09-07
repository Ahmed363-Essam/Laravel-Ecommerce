<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // categories
        DB::table('categories')->delete();
        $categories = 
        [
            ['id'=>1,'name'=>'Electronics','slug'=>'Wires','description'=>'this store is Electonics One','image'=>'d.jpg','status'=>'active'],
            ['id'=>2,'name'=>'Clothings','slug'=>'clothes','description'=>'this store is clothings One','image'=>'d.jpg','status'=>'active'],
            ['id'=>3,'name'=>'Sporting','slug'=>'sports','description'=>'this store is sports One','image'=>'d.jpg','status'=>'active'],
        ];

        DB::table('categories')->insert($categories);
    }
}
