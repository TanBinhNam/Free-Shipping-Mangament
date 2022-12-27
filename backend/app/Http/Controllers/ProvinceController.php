<?php

namespace App\Http\Controllers;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function getProvince() {
        $data = Province::get('province_name');
        return response()->json([
            'data' =>$data,
            ], 200);
    }
}
