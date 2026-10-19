<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ChatController;
// =====================================================
// 1. LANDING PAGE PÚBLICA
// =====================================================

Route::get('/', function () {
    return view('welcome');
});


// =====================================================
// 2. RUTAS DE AUTENTICACIÓN
//    Solo accesibles para usuarios NO autenticados
// =====================================================

Route::middleware(['guest', 'prevent-back-history'])->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.post');

});


// =====================================================
// 3. RUTAS PROTEGIDAS
//    Requieren usuario autenticado
// =====================================================

Route::middleware(['auth', 'prevent-back-history'])->group(function () {

    // -------------------------------------------------
    // Logout
    // -------------------------------------------------

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    // -------------------------------------------------
    // Dashboard
    // -------------------------------------------------

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // -------------------------------------------------
    // Trabajadores / Mineros
    // -------------------------------------------------

    Route::get('/workers', [WorkerController::class, 'index'])
        ->name('workers.index');

    Route::get('/workers/create', [WorkerController::class, 'create'])
        ->name('workers.create');

    Route::post('/workers', [WorkerController::class, 'store'])
        ->name('workers.store');

    Route::post('/chatbot/message', [ChatController::class, 'message'])
    -> Middleware('throttle: 20, 1')
    ->name('chatbot.message');
    Route::post('/chatbot/reset', [ChatController::class, 'reset'])
    ->name('chatbot.reset');

});