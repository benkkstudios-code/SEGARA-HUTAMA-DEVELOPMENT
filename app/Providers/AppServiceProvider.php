<?php

namespace App\Providers;

use App\Wizard\InstallWizardComponent;
use App\Wizard\Steps\UserStep;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Carbon\Carbon;

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
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        Livewire::setScriptRoute(function ($handle) {
            return Route::get('/' . env('APP_FOLDER') . '/vendor/livewire/livewire/dist/livewire.js', $handle);
        });

        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/' . env('APP_FOLDER') . '/public/livewire/update', $handle);
        });
        Model::unguard();
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&  $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $this->app['request']->server->set('HTTPS', true);
        }
    }
}
