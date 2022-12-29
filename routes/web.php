<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
//welcomeページ
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
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

    //ダッシュボード
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    //プロフィール画面
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //設備
    Route::get('facility', [FacilityController::class, 'index'])->name('facility.index');

    //設備の予約関連
    Route::get('{facilityId}/reservation', [ReservationController::class, 'create'])->name('reservation.create');
    Route::get('{facilityId}/reservation/{reservationId}', [ReservationController::class, 'show'])->name('reservation.show');
    Route::get('{facilityId}/reservation/{reservationId}', [ReservationController::class, 'edit'])->name('reservation.edit');
    Route::post('{facilityId}/reservation', [ReservationController::class, 'store'])->name('reservation.store');
    Route::put('{facilityId}/reservation/{reservationId}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::post('{facilityId}/reservation/{reservationId}', [ReservationController::class, 'delete'])->name('reservation.delete');
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
