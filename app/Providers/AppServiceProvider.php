<?php

namespace App\Providers;

use App\Models\Branch;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        $sessionKey = "selectedBranch";
        // $branchId = Branch::where('status', true)->select('id')->first();
        session()->forget($sessionKey);
        session()->forget('selectedBranch');
        // session()->put($sessionKey, $branchId->id);
    }
}
