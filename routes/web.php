<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\AntrianController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BarangController;
use App\Http\Controllers\Backend\JadwalController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('/admin/logout',[AdminController::class, 'logout' ])->name('admin.logout');

//semua route untuk user

Route::prefix('users')->group(function(){
    Route::get('/view',[UserController::class, 'UserView' ])->name('user.view');
    Route::get('/add',[UserController::class, 'UserAdd' ])->name('user.add');
    Route::post('/store',[UserController::class, 'UserStore' ])->name('users.store');
    Route::get('/edit/{id}',[UserController::class, 'UserEdit' ])->name('users.edit');
    Route::post('/update/{id}',[UserController::class, 'UserUpdate' ])->name('users.update');
    Route::get('/delete/{id}',[UserController::class, 'UserDelete' ])->name('users.delete');
});


Route::prefix('barang')->group(function(){
    Route::get('/view',[BarangController::class, 'BarangView' ])->name('barang.view');
    Route::get('/add',[BarangController::class, 'BarangAdd' ])->name('barang.add');
    Route::post('/store',[BarangController::class, 'BarangStore' ])->name('barangs.store');
    Route::get('/edit/{id}',[BarangController::class, 'BarangEdit' ])->name('barangs.edit');
    Route::post('/update/{id}',[BarangController::class, 'BarangUpdate' ])->name('barangs.update');
    Route::get('/delete/{id}',[BarangController::class, 'BarangDelete' ])->name('barangs.delete');
});

//UTS
Route::prefix('antrian')->group(function(){
    Route::get('/view',[AntrianController::class, 'AntrianView' ])->name('antrian.view');
    Route::get('/add',[AntrianController::class, 'AntrianAdd' ])->name('antrian.add');
    Route::post('/store',[AntrianController::class, 'AntrianStore' ])->name('antrians.store');
});

//Kelola Jadwal
Route::prefix('jadwal')->group(function(){
    Route::get('/view',[JadwalController::class, 'JadwalView' ])->name('jadwal.view');
    Route::get('/add',[JadwalController::class, 'JadwalAdd' ])->name('jadwal.add');
    Route::post('/store',[JadwalController::class, 'JadwalStore' ])->name('jadwal.store');
    Route::get('/edit/{id}',[JadwalController::class, 'JadwalEdit' ])->name('jadwal.edit');
    Route::post('/update/{id}',[JadwalController::class, 'JadwalUpdate' ])->name('jadwal.update');
    Route::get('/delete/{id}',[JadwalController::class, 'JadwalDelete' ])->name('jadwal.delete');
    
});