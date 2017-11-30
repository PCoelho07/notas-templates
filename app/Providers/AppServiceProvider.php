<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Carbon\Carbon::setLocale('pt_BR');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(NotaryOffice::class, function ($app) {
            $office = NotaryOffice::latest()->first();

            if (empty($office)) {
                $office = new NotaryOffice;
                $office->name = '[Cartório não cadastrado]';
            }

            return $office;
        });
    }
}
