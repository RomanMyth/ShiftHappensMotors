<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CarControllerAPI;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Login', function() {
    return view('Login');
});

Route::get('/Register', function() {
    return view('Register');
});


Route::get('/test', [TestController::class, 'getTestData']);

Route::get("/addVehicle", [CarControllerAPI::class, 'addVehicleForm']);
Route::post("/storeVehicle", [CarControllerAPI::class, 'store']);
