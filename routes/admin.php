<?php

use App\Http\Controllers\Backend\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'dashboard'])->name('dashboard');
});
