<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        /*$this->call(StoreSeeder::class);
        
        $this->call(UserSeeder::class);

        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);*/

        $this->call(AdminSeeder::class);


    }
}