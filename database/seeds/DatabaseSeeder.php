<?php

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
         $this->call(UsersTableSeeder::class);
         $this->call(TypeTableSeeder::class);
         $this->call(ManufacturerTableSeeder::class);
         $this->call(WatermarkTableSeeder::class);
    }
}
