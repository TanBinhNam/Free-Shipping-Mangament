<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Ramsey\Uuid\v1;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert([
            ['province_name'=>"Aceh/Aceh"],
            ['province_name'=>"Bali/Bali"],
            ['province_name'=>"Bangka Belitung/Bangka-Belitung Islands"],
            ['province_name'=>"Banten/Banten"],
            ['province_name'=>"Bengkulu/Bengkulu"],
            ['province_name'=>"Di Yogyakarta/Yogyakarta"],
            ['province_name'=>"DKI Jakarta/Jakarta"],
            ['province_name'=>"Gorontalo/Gorontalo"],
            ['province_name'=>"Jambi/Jambi"],
            ['province_name'=>"Jawa Barat/West Java"],
            ['province_name'=>"Jawa Tengah/Central Java"],
            ['province_name'=>"Jawa Timur/East Java"],
            ['province_name'=>"Kalimantan Barat/West Kalimantan"],
            ['province_name'=>"Kalimantan Selatan/South Kalimantan"],
            ['province_name'=>"Kalimantan Tengah/Central Kalimantan"],
            ['province_name'=>"Kalimantan Timur/East Kalimantan"],
            ['province_name'=>"Kalimantan Utara/North Kalimantan"],
            ['province_name'=>"Kepulauan Riau/Riau Islands"],
            ['province_name'=>"Lampung/Lampung"],
            ['province_name'=>"Maluku Utara/North Maluku"],
            ['province_name'=>"Maluku/Maluku"],
            ['province_name'=>"Nusa Tenggara Barat (Ntb)/West Nusa Tenggara"],
            ['province_name'=>"Nusa Tenggara Timur (Ntt)/East Nusa Tenggara"],
            ['province_name'=>"Papua Barat/West Papua"],
            ['province_name'=>"Papua/Papua"],
            ['province_name'=>"Riau/Riau"],
            ['province_name'=>"Sulawesi Barat/West Sulawesi"],
            ['province_name'=>"Sulawesi Selatan/South Sulawesi"],
            ['province_name'=>"Sulawesi Tengah/Central Sulawesi"],
            ['province_name'=>"Sulawesi Tenggara/Southeast Sulawesi"],
            ['province_name'=>"Sulawesi Utara/North Sulawesi"],
            ['province_name'=>"Sumatera Barat/West Sumatera"],
            ['province_name'=>"Sumatera Selatan/South Sumatera"],
            ['province_name'=>"Sumatera Utara/North Sumatera"],

        ]);
    }
}
