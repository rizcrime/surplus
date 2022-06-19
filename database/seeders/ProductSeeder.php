<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        DB::table('products')->insert([
            [
                "name" => "Kemeja Putih",
                "description" => "Ukuran XL",
                "enable" => "1",
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString()
            ],
            [
                "name" => "Celana Renang anti Basah",
                "description" => "Ukuran S dan XL",
                "enable" => "1",
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString()
            ], 
            [
                "name" => "Mini Air Soft Gun",
                "description" => "Cocok untuk anak pria/wanita yang sedang puber 13-22 tahun",
                "enable" => "0",
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString()
            ],
            [
                "name" => "Balon varian rasa",
                "description" => "tidak untuk anak dibawah 17 tahun",
                "enable" => "1",
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString()
            ]
        ]);
    }
}
