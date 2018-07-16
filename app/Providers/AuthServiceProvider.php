<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App\Providers;

use App\Expediente;
use App\Policies\ApproverPolicy;
use App\Policies\ExpedientePolicy;
use App\Policies\HistoryPolicy;
use App\Policies\UserPolicy;
use App\Policies\RechazadoPolicy;
use App\User;
use App\History;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Expediente::class => ExpedientePolicy::class,
        History::class => HistoryPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
