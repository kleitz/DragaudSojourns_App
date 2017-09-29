<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use \App\Repositories\Billing\Paypal;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        // view()->composer('layout.user.groups', function($view){
        //     $view->with('groups', \App\Group::archives());
        // });
        // view()->composer('layout.user.payments', function($view){
        //     $view->with('groups', \App\Payment::archives());
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      // Credit card processor key
      $this->app->singleton(Paypal::class, function(){
        return new Paypal(config('services.paypal.secret'),
                          config('services.paypal.clientId'));
      });

    }
}
