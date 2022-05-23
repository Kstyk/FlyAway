<?php

use Illuminate\Support\Facades\Route;
use App\Models\Trip;
use App\Http\Controllers\TripController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFlightController;
use App\Http\Controllers\UserBankBalanceController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/aboutus', 'contactinfo.aboutus')->name('aboutus');

Route::resource('trips', TripController::class);
Route::resource('countries', CountryController::class);
Route::resource('airports', AirportController::class);
Route::resource('flights', FlightController::class);
Route::resource('users', UserController::class);

Route::get('reserve/{id}', [UserFlightController::class, 'create'])->name('reserve');
Route::post('store', [UserFlightController::class, 'store'])->name('userflight.store');
Route::resource('userflights', UserFlightController::class);

Route::controller(UserBankBalanceController::class) -> group(function() {
    Route::get('/addmoney/{id}', 'edit')->name('addmoney');
    Route::put('/saved/{id}', 'update')->name('save');
});


require __DIR__.'/auth.php';

