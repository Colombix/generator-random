<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Domain;
use App\Models\Extension;
use App\Policies\DomainPolicy;
use App\Policies\ExtensionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */

    protected $policies = [
        Extension::class => ExtensionPolicy::class,
        Domain::class => DomainPolicy::class,
    ];
    public function boot(): void
    {
        //
    }
}
