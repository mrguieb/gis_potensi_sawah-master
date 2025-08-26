<?php
use App\Http\Controllers\Admin\UserController;
use App\Http\Livewire\Peta;
use App\Http\Livewire\Laporan;
use App\Http\Livewire\InfoSawah;
use App\Http\Livewire\HalamanUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Desa as LivewireDesa;
use App\Http\Livewire\Potensi as LivewirePotensi;
use App\Http\Livewire\Pemiliklahan as LivewirePemiliklahan;
use App\Http\Controllers\CropRecommendationController;

Route::post('/suggest-crop', [CropRecommendationController::class, 'suggestCrop']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/info_tanah', InfoSawah::class)->name('info_tanah');
Route::get('/desa', LivewireDesa::class)->name('desa');
Route::get('/pemilik_lahan', LivewirePemiliklahan::class)->name('pemilik_lahan');
Route::get('/potensi_sawah', LivewirePotensi::class)->name('potensi_sawah');
Route::get('/peta', Peta::class)->name('peta');
Route::get('/laporan', Laporan::class)->name('laporan');
Route::get('/', HalamanUser::class)->name('user');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create'); // ADD USER PAGE
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store'); // SAVE NEW USER
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});


