<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

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

Route::get('/get-data', [WeatherController::class,'gWeatherData'])->name('get-data');
Route::get('/', [WeatherController::class,'index'])->name('index');
Route::get('/graph', [WeatherController::class,'gWeatherData'])->name('graph');
Route::get('/find-data/{id}', [WeatherController::class,'find'])->name('find-data');
Route::post('/update-data/{id}', [WeatherController::class,'update'])->name('update-data');
Route::post('/delete-data', [WeatherController::class,'delete'])->name('delete-data');