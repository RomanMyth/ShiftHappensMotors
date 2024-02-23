<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarControllerAPI;
use App\Http\Controllers\MaintenanceControllerAPI;
use App\Http\Controllers\EmployeeControllerAPI;
use App\Http\Controllers\PartControllerAPI;
use App\Http\Middleware\AuthManager;
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



Route::get('/', [CarControllerAPI::class, 'index'])->name('Home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Routes Accessed by a Manager Only
Route::middleware([AuthManager::class])->group(function(){
    Route::get('/addEmployee', [EmployeeControllerAPI::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeControllerAPI::class, 'store'])->name('employees.store');
    Route::get('/addParts', [PartControllerAPI::class, 'create'])->name('Part.create');
    Route::post('/Part', [PartControllerAPI::class, 'store'])->name('Part.store');
    Route::get("/addVehicle", [CarControllerAPI::class, 'addVehicleForm']);
    Route::post("/storeVehicle", [CarControllerAPI::class, 'store']);
});


Route::get('/scheduleMaintenance', [MaintenanceControllerAPI::class, 'index']);


require __DIR__.'/auth.php';
