<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Extension;
use App\Policies\DomainPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
