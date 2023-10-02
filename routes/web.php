<?php

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
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EditController;
use Illuminate\Support\Facades\Route;

Route::get('modal', [EditController::class,'modal'])->name('modal');

// //Route::get('modal',function(){
//     return view('modal');
// });
Route::resource('pegawaiAjax',EditController::class);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('home', [AuthController::class, 'home'])->name('home');
Route::post('login/sesi', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('features', [AuthController::class,'index'])->name('features');
//Route::get('update', [EditController::class,'update'])->name('update');
// routes/web.php
// Route::get('/edit-password', [EditController::class, 'showEditForm'])->name('change.password.form');
// Route::post('/edit-password', [EditController::class, 'edit'])->name('change.password');

Route::put('/edit-password', [EditController::class, 'editp'])->middleware('auth')->name('passwordd');
Route::post('update',[EditController::class, 'editp'])->name('passwordd');
// Route::get('/change-password', [AuthController::class,'showChangePasswordForm'])->name('change.password.form');
// Route::post('/change-password',  [AuthController::class,'changePassword'])->name('change.password');
// Route::get('/lihat{id}',[EditController::class,'update'])->name('update');

// Route::get('lihat/{Id_Job_SPK}',[EditController::class,'edit'])->name('nama.edit');
// Route::get('real/{Id_Job_SPK}',[EditController::class,'real'])->name('real');

Route::get('item/{Id_Job_SPK}', [EditController::class,'up'])->name('update');
//Route::get('/modal/{Id_Job_SPK}', [EditController::class,'viewModal'])->name('viewModal');

Route::post('tambah-data-real/{Id_Job_SPK}', [EditController::class,'tambahDataReal'])->name('tambah-data');

// tes
Route::get('tes1',[EditController::class,'tes'])->name('tes1');
Route::get('tes2',[EditController::class,'tes2'])->name('tes2');

// Rute untuk controller 'EditController'
//Route::get('view-td-wp-spk/{Id_Job_SPK}', [EditController::class,'view'])->name('modal');

// Rute untuk menampilkan data 'td_wp_bkl_real' dalam modal
//Route::get('/get-td-wp-bkl-real/{Id_Job_SPK}', [EditController::class,'getTdWpBklReal'])->name('getTdWpBklReal');
