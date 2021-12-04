<?php

use App\Models\Module;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    SessionController
};


Route::middleware('guest')->as('guest.')->group(function () {
    Route::view('/', 'index')->name('home');
    Route::post('/login', [SessionController::class, 'store'])->name('login');
});

Route::middleware('auth')->as('user.')->group(function () {
   Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');
});

Route::get('/test', function () {
   return view('test');
});

Route::get('/test2', function () {
    return view('test2');
});

