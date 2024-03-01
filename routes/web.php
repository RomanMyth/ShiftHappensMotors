<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarControllerAPI;
use App\Http\Controllers\MaintenanceControllerAPI;
use App\Http\Controllers\EmployeeControllerAPI;
use App\Http\Controllers\PartControllerAPI;
use App\Http\Middleware\AuthManager;
use App\Http\Controllers\ScheduleControllerAPI;
use App\Http\Middleware\AuthEmployee;
use App\Http\Controllers\EmployeeRatingControllerAPI;
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


//checks if a user is logged in. If not brings them to the login page
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Routes Accessed by a Manager Only
    Route::middleware([AuthManager::class])->group(function(){
        Route::get('/addEmployee', [EmployeeControllerAPI::class, 'create'])->name('employees.create');
        Route::post('/employees', [EmployeeControllerAPI::class, 'store'])->name('employees.store');
        Route::get('/addParts', [PartControllerAPI::class, 'create'])->name('Part.create');
        Route::post('/Part', [PartControllerAPI::class, 'store'])->name('Part.store');
        Route::get("/addVehicle", [CarControllerAPI::class, 'addVehicleForm'])->name('Vehicle.create');
        Route::post("/storeVehicle", [CarControllerAPI::class, 'store']);
        Route::get('/newSchedule', [ScheduleControllerAPI::class, 'newSchedule'])->name('schedule');
        Route::post('/createSchedule', [ScheduleControllerAPI::class, 'store'])->name('schedule.create');
    });

    //Routes Accessed by any employee (non-customer)
    Route::middleware([AuthEmployee::class])->group(function(){
        Route::get('/viewSchedule', [ScheduleControllerAPI::class, 'index'])->name('schedule.view');
    });
});



Route::get('/scheduleMaintenance', [MaintenanceControllerAPI::class, 'index'])->name("schedule.maintenance");

Route::get('/sell-parts', [PartControllerAPI::class, 'sellParts'])->name('sell.parts');
Route::post('/sell-parts/sell/{partNumber}', [PartControllerAPI::class, 'sellPart'])->name('sell.parts.sell');
Route::post('/add-to-cart', [PartControllerAPI::class, 'addToCart'])->name('add.to.cart');
Route::post('/sell-parts/checkout', [PartControllerAPI::class, 'checkout'])->name('sell.parts.checkout');
Route::delete('/sell-parts/remove-from-cart/{partNumber}', [PartControllerAPI::class, 'removeFromCart'])->name('sell.parts.removeFromCart');

Route::get('/scheduleMaintenance', [MaintenanceControllerAPI::class, 'schMaintenanceForm']);
Route::post('/storeAppointment', [MaintenanceControllerAPI::class, 'store']);
Route::get('/checkAppointments', [MaintenanceControllerAPI::class, 'checkAppointments'] );
Route::get('/getUnavailableDates', [MaintenanceControllerAPI::class, 'getUnavailableDates']);
Route::get('/getAvailableTimes', [MaintenanceControllerAPI::class, 'getAvailableTimes']);
Route::get('/markTimeUnavailable', [MaintenanceControllerAPI::class, 'markAppointmentUnavailable']);
Route::get('/getAppointmentCount', [MaintenanceControllerAPI::class, 'getAppointmentCount']);

Route::get('/ratings/create', [EmployeeRatingControllerAPI::class, 'create'])->name('ratings.create');
Route::post('/ratings', [EmployeeRatingControllerAPI::class, 'store'])->name('ratings.store');
Route::get('/empRatings', [EmployeeRatingControllerAPI::class, 'Employee_Dropdown'])->name('empRatings');


require __DIR__.'/auth.php';
