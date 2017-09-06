<?php

namespace FactoryStories\Providers;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use FactoryStories\Commands\StoryMakeCommand;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            StoryMakeCommand::class
        ]);
    }
}
