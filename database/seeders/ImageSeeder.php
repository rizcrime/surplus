<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            [
                "name" => "pakaian kemeja",
                "file" => "https://asset.kompas.com/crops/G3cEtrAwljF2m_NfjWp2vKzaD8Y=/0x0:938x625/750x500/data/photo/2019/10/21/5dada2559db57.jpg",
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString()
            ],
            [
                "name" => "celana renang",
                "file" => "https://ae01.alicdn.com/kf/HTB1.awsQVzqK1RjSZFCq6zbxVXa9/361-Pria-Ketat-Berenang-Celana-Pendek-Klor-Tahan-Baju-Renang-Pria-Celana-Renang-Plus-Ukuran-Sexy.jpg_Q90.jpg_.webp",
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString()
            ],
            [
                "name" => "Air soft gun",
                "file" => "https://awsimages.detik.net.id/community/media/visual/2017/05/28/bf54010b-01af-4e2c-95f7-615ecf321a1a_43.jpg?w=700&q=90",
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString()
            ],
            [
                "name" => "Balon kedewasaan",
                "file" => "https://img2.pngdownload.id/20180203/swq/kisspng-balloon-birthday-clip-art-baloon-5a75df826b9d28.4651579315176743704408.jpg",
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString()
            ],
        ]);
    }
}
