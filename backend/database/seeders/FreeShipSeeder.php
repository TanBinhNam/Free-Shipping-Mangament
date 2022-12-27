<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FreeShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $province = ['Aceh/Aceh','Bali/Bali','Bangka Belitung/Bangka-Belitung Islands','Banten/Banten','Bengkulu/Bengkulu','Di Yogyakarta/Yogyakarta','DKI Jakarta/Jakarta','Gorontalo/Gorontalo','Jambi/Jambi','Jawa Barat/West Java'];
        
        for($i=0; $i<30; $i++){
            $random_province = $province[array_rand($province,1)];
            DB::table('freeships')->insert([
            'province' => $random_province,
            'minimum_spent' => 200000,
            'valid_date' => Carbon::now(),
            'expired_at' => Carbon::today()->addDays(rand(1, 365)),
            'user_id' => User::all()->random()->id,
             'created_at' => Carbon::now()
        ]);
        }
    }
}
