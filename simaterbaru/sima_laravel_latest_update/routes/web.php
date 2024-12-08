<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\DekanController;
use App\Http\Controllers\KaprodiController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;

Route::get('/get-jadwal', [JadwalController::class, 'getJadwal']);

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/password-hash',[HomeController::class,'password_hash'])->name('password_hash');

// LOGIN AND REGISTER {AUTH}
Route::match(['get','post'],'/login', [AuthController::class, 'login'])->name('auth.login');
Route::match(['get','post'],'/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::match(['get','post'],'/register', [AuthController::class, 'register'])->name('auth.register');
Route::match(['get','post'],'/forgot-password', [AuthController::class, 'forgot_password'])->name('auth.forgot_password');

// MAHASISWA ROUTE
Route::group([
    'prefix' => 'mahasiswa',
    'as' => 'mahasiswa.',
    'middleware' => [fn ($request, $next) => (new RoleMiddleware)->handle($request, $next, 'mahasiswa')],
], function () {
    Route::match(['get','post'],'/', [MahasiswaController::class, 'index'])->name('index');
});

// PEMBIMBING ROUTE
Route::group([
    'prefix' => 'pembimbing',
    'as' => 'pembimbing.',
    'middleware' => [fn ($request, $next) => (new RoleMiddleware)->handle($request, $next, 'pembimbing')],
], function () {
    Route::match(['get','post'],'/', [PembimbingController::class, 'index'])->name('index');
});

// KAPRODI ROUTE
Route::group([
    'prefix' => 'kaprodi',
    'as' => 'kaprodi.',
    'middleware' => [fn ($request, $next) => (new RoleMiddleware)->handle($request, $next, 'kaprodi')],
], function () {
    Route::match(['get','post'],'/', [KaprodiController::class, 'index'])->name('index');
});

// AKADEMIK ROUTE
Route::group([
    'prefix' => 'akademik',
    'as' => 'akademik.',
    'middleware' => [fn ($request, $next) => (new RoleMiddleware)->handle($request, $next, 'akademik')],
], function () {
    Route::match(['get','post'],'/', [AkademikController::class, 'index'])->name('index');
});

// DEKAN ROUTE
Route::group([
    'prefix' => 'dekan',
    'as' => 'dekan.',
    'middleware' => [fn ($request, $next) => (new RoleMiddleware)->handle($request, $next, 'dekan')],
], function () {
    Route::match(['get','post'],'/', [DekanController::class, 'index'])->name('index');
});