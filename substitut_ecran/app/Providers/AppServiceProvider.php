<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\OPJ;
use App\Observers\OPJObserver;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        OPJ::observe(OPJObserver::class);
    }
}
