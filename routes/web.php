<?php

use Illuminate\Support\Facades\Route;
use App\Models\Trip;
use App\Http\Controllers\TripController;


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

// Route::controller(TripController::class)->group(function() {
//     Route::get('/', 'index') -> name('trips.index');
//     Route::get('/trips/{id}', 'show') -> name('trips.show');
// });

