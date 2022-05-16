<?php

use Illuminate\Support\Facades\Route;
use App\Models\Trip;
use App\Http\Controllers\TripController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AirportController;


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

Route::resource('trips', TripController::class);
Route::resource('countries', CountryController::class);
Route::resource('airports', AirportController::class);

require __DIR__.'/auth.php';

