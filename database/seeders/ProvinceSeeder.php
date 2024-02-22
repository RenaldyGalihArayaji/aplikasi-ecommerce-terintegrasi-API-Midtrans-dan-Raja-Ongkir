<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::withHeaders([
            'key' => 'b3842f7a568a7b2ce694e33be4e8987f'
        ])->get('https://api.rajaongkir.com/starter/province');

        $province = $response['rajaongkir']['results'];
        foreach ($province as $p) {
            $data_province[] = [
                "id" => $p["province_id"],
                "province" => $p["province"]
            ];
        }

        Province::insert($data_province);
    }
}
