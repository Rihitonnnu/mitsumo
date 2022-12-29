<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//welcomeページ
Route::get('/', function () {
    return view('welcome');
});

//未ログインユーザー
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

//一般ユーザーと管理者
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    //プロフィール画面
    Route::get('profile/{profileId}', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile/{profileId}', [ProfileController::class, 'update'])->name('profile.update');

    //設備
    Route::get('facility',[FacilityController::class,'index'])->name('facility.index');

    //設備の予約関連
    Route::get('{facilityId}/reservation',[ReservationController::class,'create'])->name('reservation.create');
    Route::get('{facilityId}/reservation/{reservationId}',[ReservationController::class,'show'])->name('reservation.show');
    Route::get('{facilityId}/reservation/{reservationId}',[ReservationController::class,'edit'])->name('reservation.edit');
    Route::post('{facilityId}/reservation',[ReservationController::class,'store'])->name('reservation.store');
    Route::put('{facilityId}/reservation/{reservationId}',[ReservationController::class,'update'])->name('reservation.update');
    Route::post('{facilityId}/reservation/{reservationId}',[ReservationController::class,'delete'])->name('reservation.delete');
});

//一般ユーザーのみ
Route::middleware('can:normal')->group(function () {
});

//管理者のみ
Route::middleware('can:admin')->group(function () {
    //ユーザー関連
    Route::get('user',[UserController::class,'index'])->name('user.index');
    Route::get('user/create',[UserController::class,'create'])->name('user.create');
    Route::get('user/{userId}',[UserController::class,'show'])->name('user.show');
    Route::post('user/{userId}',[UserController::class,'delete'])->name('user.delete');

    //設備関連
    Route::get('facility/create',[FacilityController::class,'create'])->name('facility.create');
    Route::get('facility/{facilityId}',[FacilityController::class,'edit'])->name('facility.edit');
    Route::post('facility',[FacilityController::class,'store'])->name('facility.store');
    Route::post('facility/{facilityId}',[FacilityController::class,'update'])->name('facility.update');
    Route::post('facility/{facilityId}',[FacilityController::class,'delete'])->name('facility.delete');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
