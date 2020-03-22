<?php

namespace Quill\SeoScore;

use Vellum\Module\Quill;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Quill\SeoScore\Listeners\RegisterSeoScoreModule;
use Quill\SeoScore\Listeners\RegisterSeoScorePermissionModule;
use Quill\SeoScore\Resource\SeoScoreResource;
use App\Resource\SeoScore\SeoScoreRootResource;
use Quill\SeoScore\Models\SeoScoreObserver;

class SeoScoreServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadModuleCommands();
        $this->loadRoutesFrom(__DIR__ . '/routes/seoscore.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'seoscore');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/config/seoscore.php', 'seoscore');

        SeoScoreResource::observe(SeoScoreObserver::class);

        if (class_exists('App\Resource\SeoScore\SeoScoreRootResource')) {
        	SeoScoreRootResource::observe(SeoScoreObserver::class);
        }

        $this->publishes([
        	__DIR__ . '/public/js' => public_path('vendor/seoscore/js')
        ], 'seoscore.js');

        $this->publishes([
            __DIR__ . '/config/seoscore.php' => config_path('seoscore.php'),
        ], 'seoscore.config');

        $this->publishes([
           __DIR__ . '/views' => resource_path('views/vendor/seoscore'),
        ], 'seoscore.views');

    }

    public function register()
    {
        Event::listen(Quill::MODULE, RegisterSeoScoreModule::class);
        Event::listen(Quill::PERMISSION, RegisterSeoScorePermissionModule::class);
    }

    public function loadModuleCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([

            ]);
        }
    }
}
