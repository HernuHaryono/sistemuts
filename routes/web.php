<?php

use App\Http\Controllers\BorangdosenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UploadDataController;

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


route::get('/registrasi', [LoginController::class, 'registrasi'])->name('registrasi');
route::post('/simpanregistrasi', [LoginController::class, 'simpanregistrasi'])->name('simpanregistrasi');
route::get('/login', [LoginController::class, 'halamanlogin'])->name('login');
route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
route::get('/logout', [LoginController::class, 'logout'])->name('logout');

route::group(['middleware' => ['auth']], function () {
    route::get('/home', [HomeController::class, 'index'])->name('home');
});


// gabungkan route yang satu controller         // proteksi dengan middleware
Route::controller(BorangdosenController::class)->middleware('auth')->group(function () {
    route::get('/borangdosen', 'borangdosen')->name('borangdosen');
    route::post('/insertdata', 'insertdata')->name('insertdata');
    route::get('/tampilkandata/{id}', 'tampilkandata')->name('tampilkandata');
    route::post('/updatedata/{id}', 'updatedata')->name('updatedata');
    route::get('/delete/{id}', 'delete')->name('delete');
});

route::get('/tambahdokumen', [HomeController::class, 'tambahdokumen'])->name('tambahdokumen');

route::get('/uploadfile/{id}', [UploadDataController::class, 'uploadfile'])->name('uploadfile');
