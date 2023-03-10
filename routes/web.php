<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FacilityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Inertia\Inertia;

//ログインページ
Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

//未ログインユーザー
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

//一般ユーザーと管理者
Route::middleware('auth')->group(function () {
    //ログアウト
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    //プロフィール画面
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //設備
    Route::get('facility', [FacilityController::class, 'index'])->name('facility.index');

    //設備の予約関連
    Route::get('facility/{facilityId}/reservation', [ReservationController::class, 'index'])->name('reservation.index');
    Route::get('facility/{facilityId}/reservation/{reservationId}', [ReservationController::class, 'show'])->name('reservation.show');
    Route::get('facility/{facilityId}/reservation/{reservationId}', [ReservationController::class, 'edit'])->name('reservation.edit');
    Route::post('facility/{facilityId}/reservation', [ReservationController::class, 'store'])->name('reservation.store');
    Route::put('facility/{facilityId}/reservation/{reservationId}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::post('facility/{facilityId}/reservation/{reservationId}', [ReservationController::class, 'delete'])->name('reservation.delete');
});

//管理者のみ
Route::middleware('can:admin')->group(function () {
    //ユーザー関連
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('user/{userId}', [UserController::class, 'show'])->name('user.show');
    Route::post('user/{userId}', [UserController::class, 'delete'])->name('user.delete');

    //設備関連
    Route::get('facility/create', [FacilityController::class, 'create'])->name('facility.create');
    Route::get('facility/{facilityId}', [FacilityController::class, 'edit'])->name('facility.edit');
    Route::post('facility', [FacilityController::class, 'store'])->name('facility.store');
    Route::post('facility/{facilityId}', [FacilityController::class, 'update'])->name('facility.update');
    Route::post('facility/{facilityId}', [FacilityController::class, 'delete'])->name('facility.delete');
});

require __DIR__ . '/auth.php';
