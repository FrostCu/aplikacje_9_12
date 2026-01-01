<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Carbon::setLocale('pl');
        setlocale(LC_TIME, 'pl_PL.UTF-8', 'pl', 'pl_PL', 'polish_poland');
    }
}
