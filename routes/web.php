<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CarControllerAPI;
use App\Http\Controllers\MaintenanceControllerAPI;
use App\Http\Controllers\EmployeeControllerAPI;
use App\Http\Controllers\PartControllerAPI;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [CarControllerAPI::class, 'index']);

Route::get('/Login', function() {
    return view('Login');
});

Route::get('/Register', function() {
    return view('Register');
});


Route::get('/test', [TestController::class, 'getTestData']);

Route::get("/addVehicle", [CarControllerAPI::class, 'addVehicleForm']);
Route::post("/storeVehicle", [CarControllerAPI::class, 'store']);


Route::get('/scheduleMaintenance', [MaintenanceControllerAPI::class, 'index']);

Route::get('/addEmployee', [EmployeeControllerAPI::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeControllerAPI::class, 'store'])->name('employees.store');

Route::get('/addParts', [PartControllerAPI::class, 'create'])->name('Part.create');
Route::post('/Part', [PartControllerAPI::class, 'store'])->name('Part.store');

Route::get('/sell-parts', [PartControllerAPI::class, 'sellParts'])->name('sell.parts');
Route::post('/sell-parts/sell/{partNumber}', [PartControllerAPI::class, 'sellPart'])->name('sell.parts.sell');
Route::post('/add-to-cart', [PartControllerAPI::class, 'addToCart'])->name('add.to.cart');
Route::post('/sell-parts/checkout', [PartControllerAPI::class, 'checkout'])->name('sell.parts.checkout');
Route::delete('/sell-parts/remove-from-cart/{partNumber}', [PartControllerAPI::class, 'removeFromCart'])->name('sell.parts.removeFromCart');

