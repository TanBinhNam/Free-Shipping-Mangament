<?php

use App\Http\Controllers\FreeShipController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProvinceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/freeship', [FreeShipController::class, 'index']);

Route::get('/getfreeship/{id}', [FreeShipController::class, 'getFreeshipInfo']);

Route::post('/freeship-update', [FreeShipController::class, 'update']);  

Route::post('/freeship-add', [FreeShipController::class, 'store']);  

Route::get('/freeship-delete/{id}', [FreeShipController::class, 'delete']);  

Route::get('/history', [HistoryController::class, 'index']);

Route::get('/get-province', [ProvinceController::class, 'getProvince']);