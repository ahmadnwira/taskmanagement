<?php

namespace App\Providers;

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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('board-owner', function($user, $board){

            $allowed = false;

            if($user->id === $board->user_id){
                $allowed = true;
            }

            if(sizeof(($board->users)) > 0 and $user->id === $board->users[0]->id){
                $allowed = true;
            }

            return $allowed;

        });
    }
}
