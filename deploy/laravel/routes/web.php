<?php

use App\Http\Controllers\KasController;
use App\Http\Controllers\DanaController;
use App\Http\Controllers\KreusController;
use App\Http\Controllers\IltekController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

// root
Route::get('/', [KasController::class, 'index']);

// login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// ganti password
Route::get('/ubah-kata-sandi', [LoginController::class, 'change'])->middleware('auth');
Route::post('/ubah-kata-sandi', [LoginController::class, 'save'])->middleware('auth');

// kas
Route::get('/kas', [KasController::class, 'index']);
Route::get('/kas/history', [KasController::class, 'history'])->middleware('bendahara');
Route::get('/kas/manage/{id}', [KasController::class, 'manage'])->middleware('bendahara');
Route::resource('/kas', 'KasController')->except(['index'])->middleware('bendahara');

// deposit
Route::get('/deposit', [DepositController::class, 'index']);
Route::get('/deposit/history', [DepositController::class, 'history']);
Route::resource('/deposit', 'DepositController')->except(['index', 'history'])->middleware('bendahara');

// laporan kreus
Route::resource('/laporan-kreus', 'KreusController')->middleware('kreus');
Route::get('/laporan-kreus/create/{kat}', [KreusController::class, 'create'])->middleware('kreus');

// laporan iltek
Route::resource('/laporan-iltek', 'IltekController')->middleware('iltek');
Route::get('/laporan-iltek/create/{kat}', [IltekController::class, 'create'])->middleware('iltek');

// riwayat transaksi
Route::resource('/transaksi', 'TransaksiController')->middleware('bendahara');

// rekapitulasi saldo
Route::get('/saldo', [SaldoController::class, 'index'])->middleware('bendahara');

// sumber dana
Route::resource('/dana', 'DanaController')->middleware('bendahara');
