<?php

use App\Http\Controllers\api\clientController;
use App\Http\Controllers\api\transactionController;
use App\Http\Controllers\api\userController;

use App\Http\Controllers\ressource\userResController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::apiResource("user",userController::class);
Route::apiResource("user",userResController::class);
Route::apiResource("transaction",transactionController::class);
Route::apiResource("client",clientController::class);
