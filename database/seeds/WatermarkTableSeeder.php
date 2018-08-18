<?php

use Illuminate\Database\Seeder;

class WatermarkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('watermarks')->insert([
            'image' => 'watermarks\test-watermark.png',
        ]);
    }
}
