<?php

use App\Http\Controllers\Brand\BrandController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('brands/toplist', [BrandController::class, 'getTopListByCountry']);
Route::apiResource('brands',BrandController::class);
