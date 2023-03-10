<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {     
        for($i=0; $i<4; $i++){
            DB::table('users')->insert([
            'name' => Str::random(4),
            'email' => 'test'.$i.'@gmail.com',
            'password' => Hash::make('123'),
        ]);
    }
    }
}
