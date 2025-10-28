<?php

use App\Models\Form;
use App\Models\IzinPenelitian;
use Illuminate\Support\Facades\Route;
use App\Notifications\ServicesRequest;
use App\Http\Middleware\OperatorSchool;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use Illuminate\Container\Attributes\Auth;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KuotaController;
use App\Http\Controllers\Admin\SBaruController;
use App\Http\Controllers\Admin\SLamaController;
use App\Http\Controllers\User\ProfilController;
use App\Http\Controllers\User\SchoolController;
use App\Http\Controllers\Admin\MutasiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ServicesRequestController;
use App\Http\Controllers\Admin\SuperadminController;
use App\Http\Controllers\Operator\OperatorController;
use App\Http\Controllers\Operator\KuotaKelasController;
use App\Http\Controllers\User\SBaruController as UserSBaruController;
use App\Http\Controllers\User\SLamaController as UserSLamaController;
use App\Http\Controllers\Operator\SBaruController as OperatorSBaruController;
use App\Http\Controllers\Operator\SLamaController as OperatorSLamaController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Operator\MutasiController as OperatorMutasiController;
use App\Http\Controllers\User\MutasiSiswaController as UserMutasiSiswaController;

// Route untuk halaman home
Route::get('/', function () {
    return view('user.msekretariat');
})->name('home');

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/post', [AuthController::class, 'loginProcess'])->name('login.post');
    Route::get('/registration', [AuthController::class, 'registration'])->name('user.registration');
    Route::post('user/registration/post', [AuthController::class, 'registrationProcess'])->name('user.registration.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'auth:user'], function(){
    Route::get('form', [FormController::class, 'create'])->name('form.create');
    Route::post('form', [FormController::class, 'store'])->name('form.store');

    Route::get('/beranda', [AuthController::class, 'showmsekretariat'])->name('home2');
    Route::get('/layanan', [AuthController::class, 'showservices'])->name('services');
    // Route::get('/sekolah', [SchoolController::class, 'showschools'])->name('schools');
    Route::get('/sekolah', [SchoolController::class, 'index'])->name('schools');
    Route::post('/sekolah/update-kuota', [SchoolController::class, 'updateKuota']);
    // Route::get('/sekolah', [SchoolController::class, 'getSchools'])->name('user.getSchools');
    Route::get('detail/sekolah/{id}', [SchoolController::class, 'show'])->name('schools.details');
    // Route::get('/profil', [AuthController::class, 'showProfil'])->name('profil');

    Route::get('/form-mutasi-siswa', [UserMutasiSiswaController::class, 'create'])->name('user.mutasi_siswa.create');
    Route::post('/mutasi-siswa-dalam/store', [UserMutasiSiswaController::class, 'store'])->name('user.mutasi_siswa.store');
    Route::post('/mutasi-siswa-luar/store', [UserMutasiSiswaController::class, 'storeLuar'])->name('user.mutasi_siswa_luar.store');
    Route::get('/mutasi-siswa/detail/{tipe}/{id}', [UserMutasiSiswaController::class, 'show'])->name('user.lapordetails');

    Route::get('/form-mutasi-masuk', [UserSBaruController::class, 'create'])->name('user.sbaru.create');
    Route::post('/mutasi-masuk-dalam/store', [UserSBaruController::class, 'store'])->name('user.sbaru.store');
    Route::post('/mutasi-masuk-luar/store', [UserSBaruController::class, 'storeLuar'])->name('user.sbaru-luar.store');
    Route::get('/mutasi-masuk/detail/{tipe}/{id}', [UserSBaruController::class, 'show'])->name('user.sbarudetails');

    Route::get('/form-mutasi-keluar', [UserSLamaController::class, 'create'])->name('user.slama.create');
    Route::post('/mutasi-keluar/store', [UserSLamaController::class, 'store'])->name('user.slama.store');
    Route::post('/mutasi-keluar-luar/store', [UserSLamaController::class, 'storeLuar'])->name('user.slama-luar.store');
    Route::get('/mutasi-keluar/detail/{tipe}/{id}', [UserSLamaController::class, 'show'])->name('user.slamadetails');

    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/profil/load/{type}', [ProfilController::class, 'loadMutasi']);
});

Route::group(['middleware' => 'auth:admin'], function(){
    Route::resource('admin/services', ServiceController::class); // CRUD Layanan
    Route::resource('admin/form', FormController::class); // CRUD Layanan

    Route::get('admin/registration', [AdminController::class, 'adminregist'])->name('admin.registration');
    Route::post('admin/registration/post', [AdminController::class, 'adminregistProcess'])->name('admin.registration.post');
    Route::get('/admin/akun_admin', [AdminController::class, 'index'])->name('admin.akun_admin');
    
    Route::get('/admin/notifications', [AdminController::class, 'showNotifications'])->name('admin.notifications');
    Route::get('/admin/notifications/read-all', [AdminController::class, 'markAsRead'])->name('admin.notifications.read');

    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('admin/dashboard/update-kuota', [DashboardController::class, 'updateKuota']);
    Route::get('/admin/dashboard/export-mutasi/{year}', [DashboardController::class, 'exportMutasi'])->name('admin.export.mutasi');
    // Route::get('admin/dashboard', [KuotaController::class, 'index']);
    // Route::get('admin/dashboard', [DashboardController::class, 'totalMutasi'])->name('admin.dashboard');

    Route::get('admin/mutasi_siswa', [MutasiController::class, 'index'])->name('admin.mutasi_siswa');
    Route::get('admin/mutasi_siswa/create', [MutasiController::class, 'create'])->name('admin.mutasi_siswa.create');
    Route::post('admin/mutasi_siswa', [MutasiController::class, 'store'])->name('admin.mutasi_siswa.store');
    Route::post('admin/mutasi_keluar/store', [MutasiController::class, 'storeLuar'])->name('admin.mutasi_siswa_luar.store');
    Route::get('admin/mutasi_siswa/edit/{tipe}/{id}', [MutasiController::class, 'edit'])->name('admin.mutasi_siswa.edit');
    Route::put('admin/mutasi_siswa/edit/{tipe}/{id}', [MutasiController::class, 'update'])->name('admin.mutasi_siswa.update');
    Route::delete('admin/mutasi_siswa/delete/{jenis}/{id}', [MutasiController::class, 'destroy'])->name('admin.mutasi_siswa.destroy');
    Route::get('admin/mutasi_siswa/show/{tipe}/{id}', [MutasiController::class, 'show'])->name('admin.mutasi_siswa.show');
    Route::get('admin/mutasi_siswa/filter', [MutasiController::class, 'filter'])->name('admin.mutasi_siswa.filter');
    Route::get('admin/mutasi_siswa/pdf', [MutasiController::class, 'generatePDF'])->name('admin.mutasi_siswa.pdf');
    Route::get('admin/mutasi_siswa/excel/', [MutasiController::class, 'export'])->name('admin.mutasi_siswa.excel');


    Route::get('admin/mutasi_masuk', [SBaruController::class, 'index'])->name('admin.sbaru');
    Route::get('admin/mutasi_masuk/create', [SBaruController::class, 'create'])->name('admin.sbaru.create');
    Route::post('admin/mutasi_masuk', [SBaruController::class, 'store'])->name('admin.sbaru.store');
    Route::get('admin/mutasi_masuk/edit/{id}', [SBaruController::class, 'edit'])->name('admin.sbaru.edit');
    Route::put('admin/mutasi_masuk/edit/{id}', [SBaruController::class, 'update'])->name('admin.sbaru.update');
    Route::delete('admin/mutasi_masuk/delete/{id}', [SBaruController::class, 'destroy'])->name('admin.sbaru.destroy');
    Route::get('admin/mutasi_masuk/show/{tipe}/{id}', [SBaruController::class, 'show'])->name('admin.sbaru.show');
    Route::get('admin/mutasi_masuk/filter', [SBaruController::class, 'filter'])->name('admin.sbaru.filter');
    Route::get('admin/mutasi_masuk/pdf', [SBaruController::class, 'generatePDF'])->name('admin.sbaru.pdf');
    Route::get('admin/mutasi_masuk/excel/', [SBaruController::class, 'export'])->name('admin.sbaru.excel');

    Route::get('admin/mutasi_keluar', [SLamaController::class, 'index'])->name('admin.slama');
    Route::get('admin/mutasi_keluar/create', [SLamaController::class, 'create'])->name('admin.slama.create');
    Route::post('admin/mutasi_keluar', [SLamaController::class, 'store'])->name('admin.slama.store');
    Route::get('admin/mutasi_keluar/edit/{id}', [SLamaController::class, 'edit'])->name('admin.slama.edit');
    Route::put('admin/mutasi_keluar/edit/{id}', [SLamaController::class, 'update'])->name('admin.slama.update');
    Route::delete('admin/mutasi_keluar/delete/{id}', [SLamaController::class, 'destroy'])->name('admin.slama.destroy');
    Route::get('admin/mutasi_keluar/show/{tipe}/{id}', [SLamaController::class, 'show'])->name('admin.slama.show');
    Route::get('admin/mutasi_keluar/filter', [SLamaController::class, 'filter'])->name('admin.slama.filter');
    Route::get('admin/mutasi_keluar/pdf', [SLamaController::class, 'generatePDF'])->name('admin.slama.pdf');
    Route::get('admin/mutasi_keluar/excel/', [SLamaController::class, 'export'])->name('admin.slama.excel');
});

Route::group(['middleware' => 'auth:superadmin'], function(){
    Route::get('superadmin/registration', [SuperadminController::class, 'superadminregist'])->name('superadmin.registration');
    Route::post('superadmin/registration/post', [SuperadminController::class, 'superadminregistProcess'])->name('superadmin.registration.post');
    Route::get('/superadmin/akun_superadmin', [SuperadminController::class, 'index'])->name('superadmin.akun_superadmin');
    
    Route::get('/superadmin/notifications', [SuperadminController::class, 'showNotifications'])->name('superadmin.notifications');
    Route::get('/superadmin/notifications/read-all', [SuperadminController::class, 'markAsRead'])->name('superadmin.notifications.read');

});


Route::group(['middleware' => 'auth:operator'], function(){

    Route::get('operator/registration', [OperatorController::class, 'operatorregist'])->name('operator.registration');
    Route::post('operator/registration/post', [OperatorController::class, 'operatorregistProcess'])->name('operator.registration.post');
    Route::get('/operator/pengaturan', [OperatorController::class, 'index'])->name('operator.pengaturan');
    
    Route::get('/operator/notifications', [OperatorController::class, 'showNotifications'])->name('operator.notifications');
    Route::get('/operator/notifications/read-all', [OperatorController::class, 'markAsRead'])->name('operator.notifications.read');

    Route::get('operator/mutasi_siswa', [OperatorMutasiController::class, 'index'])->name('operator.mutasi_siswa');
    Route::get('operator/mutasi_siswa/create', [OperatorMutasiController::class, 'create'])->name('operator.mutasi_siswa.create');
    Route::post('operator/mutasi_siswa', [OperatorMutasiController::class, 'store'])->name('operator.mutasi_siswa.store');
    Route::get('operator/mutasi_siswa/edit/{id}', [OperatorMutasiController::class, 'edit'])->name('operator.mutasi_siswa.edit');
    Route::put('operator/mutasi_siswa/edit/{id}', [OperatorMutasiController::class, 'update'])->name('operator.mutasi_siswa.update');
    Route::delete('operator/mutasi_siswa/delete/{id}', [OperatorMutasiController::class, 'destroy'])->name('operator.mutasi_siswa.destroy');
    Route::get('operator/mutasi_siswa/show/{id}', [OperatorMutasiController::class, 'show'])->name('operator.mutasi_siswa.show');
    Route::get('operator/mutasi_siswa/filter', [OperatorMutasiController::class, 'filter'])->name('operator.mutasi_siswa.filter');
    Route::get('operator/mutasi_siswa/pdf', [OperatorMutasiController::class, 'generatePDF'])->name('operator.mutasi_siswa.pdf');
    Route::get('operator/mutasi_siswa/excel/', [OperatorMutasiController::class, 'export'])->name('operator.mutasi_siswa.excel');

    Route::get('operator/mutasi_masuk', [OperatorSBaruController::class, 'index'])->name('operator.sbaru');
    Route::get('operator/mutasi_masuk/create', [OperatorSBaruController::class, 'create'])->name('operator.sbaru.create');
    Route::post('operator/mutasi_masuk', [OperatorSBaruController::class, 'store'])->name('operator.sbaru.store');
    Route::post('operator/mutasi_masuk/store', [OperatorSBaruController::class, 'storeLuar'])->name('operator.sbaru-luar.store');
    Route::get('operator/mutasi_masuk/edit/{tipe}/{id}', [OperatorSBaruController::class, 'edit'])->name('operator.sbaru.edit');
    Route::put('operator/mutasi_masuk/edit/{tipe}/{id}', [OperatorSBaruController::class, 'update'])->name('operator.sbaru.update');
    Route::delete('operator/mutasi_masuk/delete/{jenis}/{id}', [OperatorSBaruController::class, 'destroy'])->name('operator.sbaru.destroy');
    Route::get('operator/mutasi_masuk/show/{tipe}/{id}', [OperatorSBaruController::class, 'show'])->name('operator.sbaru.show');
    Route::get('operator/mutasi_masuk/filter', [OperatorSBaruController::class, 'filter'])->name('operator.sbaru.filter');
    Route::get('operator/mutasi_masuk/pdf', [OperatorSBaruController::class, 'generatePDF'])->name('operator.sbaru.pdf');
    Route::get('operator/mutasi_masuk/excel/', [OperatorSBaruController::class, 'export'])->name('operator.sbaru.excel');
    Route::put('/kuota/update/{id}', [KuotaKelasController::class, 'update'])->name('kuota.update');


    Route::get('operator/mutasi_keluar', [OperatorSLamaController::class, 'index'])->name('operator.slama');
    Route::get('operator/mutasi_keluar/create', [OperatorSLamaController::class, 'create'])->name('operator.slama.create');
    Route::post('operator/mutasi_keluar/store', [OperatorSLamaController::class, 'store'])->name('operator.slama.store');
    Route::post('operator/mutasi_keluar', [OperatorSLamaController::class, 'storeLuar'])->name('operator.slama-luar.store');
    Route::get('operator/mutasi_keluar/edit/{tipe}/{id}', [OperatorSLamaController::class, 'edit'])->name('operator.slama.edit');
    Route::put('operator/mutasi_keluar/edit/{tipe}/{id}', [OperatorSLamaController::class, 'update'])->name('operator.slama.update');
    Route::delete('operator/mutasi_keluar/delete/{jenis}/{id}', [OperatorSLamaController::class, 'destroy'])->name('operator.slama.destroy');
    Route::get('operator/mutasi_keluar/show/{tipe}/{id}', [OperatorSLamaController::class, 'show'])->name('operator.slama.show');
    Route::get('operator/mutasi_keluar/filter', [OperatorSLamaController::class, 'filter'])->name('operator.slama.filter');
    Route::get('operator/mutasi_keluar/pdf', [OperatorSLamaController::class, 'generatePDF'])->name('operator.slama.pdf');
    Route::get('operator/mutasi_keluar/excel/', [OperatorSLamaController::class, 'export'])->name('operator.slama.excel');
});




