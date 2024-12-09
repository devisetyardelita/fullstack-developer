<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IzinPenelitianController;
use App\Http\Controllers\PengaduanLangsungController;
use App\Http\Controllers\PengaduanTidakLangsungController;

Route::get('admin/login', [AuthController::class, 'login'])->name('login');
Route::post('admin/login/post', [AuthController::class, 'loginProcess'])->name('login.post');
Route::get('admin/registration', [AuthController::class, 'registration'])->name('registration');
Route::post('admin/registration/post', [AuthController::class, 'registrationProcess'])->name('registration.post');
Route::get('admin/logout', [AuthController::class, 'logout'])->name('logout');
Route::group(['middleware' => 'auth'], function(){
    Route::get('admin/pengaduan_tidak_langsung', [PengaduanTidakLangsungController::class, 'index'])->name('pengaduan_tidak_langsung');
    Route::get('admin/pengaduan_tidak_langsung/create', [PengaduanTidakLangsungController::class, 'create'])->name('pengaduan_tidak_langsung.create');
    Route::post('admin/pengaduan_tidak_langsung', [PengaduanTidakLangsungController::class, 'store'])->name('pengaduan_tidak_langsung.store');
    Route::get('admin/pengaduan_tidak_langsung/edit/{id}', [PengaduanTidakLangsungController::class, 'edit'])->name('pengaduan_tidak_langsung.edit');
    Route::put('admin/pengaduan_tidak_langsung/edit/{id}', [PengaduanTidakLangsungController::class, 'update'])->name('pengaduan_tidak_langsung.update');
    Route::delete('admin/pengaduan_tidak_langsung/delete/{id}', [PengaduanTidakLangsungController::class, 'destroy'])->name('pengaduan_tidak_langsung.destroy');
    Route::get('admin/pengaduan_tidak_langsung/show/{id}', [PengaduanTidakLangsungController::class, 'show'])->name('pengaduan_tidak_langsung.show');
    Route::get('admin/pengaduan_tidak_langsung/filter', [PengaduanTidakLangsungController::class, 'filter'])->name('pengaduan_tidak_langsung.filter');
    Route::get('admin/pengaduan_tidak_langsung/pdf', [PengaduanTidakLangsungController::class, 'generatePDF'])->name('pengaduan_tidak_langsung.pdf');
    Route::get('admin/pengaduan_tidak_langsung/excel/', [PengaduanTidakLangsungController::class, 'export'])->name('pengaduan_tidak_langsung.excel');

    Route::get('admin/pengaduan_langsung', [PengaduanLangsungController::class, 'index'])->name('pengaduan_langsung');
    Route::get('admin/pengaduan_langsung/create', [PengaduanLangsungController::class, 'create'])->name('pengaduan_langsung.create');
    Route::post('admin/pengaduan_langsung', [PengaduanLangsungController::class, 'store'])->name('pengaduan_langsung.store');
    Route::get('admin/pengaduan_langsung/edit/{id}', [PengaduanLangsungController::class, 'edit'])->name('pengaduan_langsung.edit');
    Route::put('admin/pengaduan_langsung/edit/{id}', [PengaduanLangsungController::class, 'update'])->name('pengaduan_langsung.update');
    Route::delete('admin/pengaduan_langsung/delete/{id}', [PengaduanLangsungController::class, 'destroy'])->name('pengaduan_langsung.destroy');
    Route::get('admin/pengaduan_langsung/show/{id}', [PengaduanLangsungController::class, 'show'])->name('pengaduan_langsung.show');
    Route::get('admin/pengaduan_langsung/filter', [PengaduanLangsungController::class, 'filter'])->name('pengaduan_langsung.filter');
    Route::get('admin/pengaduan_langsung/pdf', [PengaduanLangsungController::class, 'generatePDF'])->name('pengaduan_langsung.pdf');
    Route::get('admin/pengaduan_langsung/excel/', [PengaduanLangsungController::class, 'export'])->name('pengaduan_langsung.excel');

    Route::get('admin/izin_penelitian', [IzinPenelitianController::class, 'index'])->name('izin_penelitian');
    Route::get('admin/izin_penelitian/create', [IzinPenelitianController::class, 'create'])->name('izin_penelitian.create');
    Route::post('admin/izin_penelitian', [IzinPenelitianController::class, 'store'])->name('izin_penelitian.store');
    Route::get('admin/izin_penelitian/edit/{id}', [IzinPenelitianController::class, 'edit'])->name('izin_penelitian.edit');
    Route::put('admin/izin_penelitian/edit/{id}', [IzinPenelitianController::class, 'update'])->name('izin_penelitian.update');
    Route::delete('admin/izin_penelitian/delete/{id}', [IzinPenelitianController::class, 'destroy'])->name('izin_penelitian.destroy');
    Route::get('admin/izin_penelitian/show/{id}', [IzinPenelitianController::class, 'show'])->name('izin_penelitian.show');
    Route::get('admin/izin_penelitian/filter', [IzinPenelitianController::class, 'filter'])->name('izin_penelitian.filter');
    Route::get('admin/izin_penelitian/pdf', [IzinPenelitianController::class, 'generatePDF'])->name('izin_penelitian.pdf');
    Route::get('admin/izin_penelitian/excel/', [IzinPenelitianController::class, 'export'])->name('izin_penelitian.excel');

});




