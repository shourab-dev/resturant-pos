<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Backend\Branch;
use App\Livewire\Backend\Campaign;
use App\Livewire\Backend\Category;
use App\Livewire\Backend\Dashboard;
use App\Livewire\Backend\Food;
use App\Livewire\Backend\Pos;
use App\Livewire\Backend\Profile;
use App\Livewire\Utils\Foods\AddFoodCanvas;
use App\Livewire\Utils\Foods\AddVariationFoods;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/register', Register::class)->name('register')->middleware('auth');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    //* PROFILE ROUTES
    Route::get('/profile', Profile::class)->name('profile');



    //* MANAGE BRANCH
    Route::get('/branch', Branch::class)->name('branch');

    //* MANAGE CATEGORY
    Route::get('/categories',  Category::class)->name('category');


    //* MANAGE FOODS
    Route::prefix('/foods')->name('foods.')->group(function () {
        Route::get('/',  Food::class)->name('view');
        Route::get('/add/{id?}',  AddFoodCanvas::class)->name('add');
    });

    //* Campaigns
    Route::prefix('/campaign')->name('campaign.')->group(function(){
        Route::get('/', Campaign::class)->name('view');
    });

    //* MANAGE POS & ORDERS
    Route::prefix('/orders')->name('pos.')->group(function () {
        Route::get('/', Pos::class)->name('all');
    });
});
