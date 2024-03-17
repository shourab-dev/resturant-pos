<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
