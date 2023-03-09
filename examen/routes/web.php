<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MultasController;
use App\Http\Controllers\UserController;

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
Route::post('/login', [IndexController::class, 'login']);
Route::get('/logout', function () {
    if(isset($_SESSION))session_destroy();
    return view('welcome');
});
Route::get('/pagar/{id}/{user}', [MultasController::class, 'pagar']);
Route::get('/pagar/{id}/{user}/pagado', [MultasController::class, 'pagado']);
Route::get('/nuevamulta/{id}', [MultasController::class, 'nuevamulta']);
Route::get('/nuevamulta/{id}/addmulta', [MultasController::class, 'guardar']);
Route::get('/resetearpuntos', [UserController::class, 'resetearpuntos']);

