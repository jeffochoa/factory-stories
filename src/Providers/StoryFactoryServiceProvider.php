<?php

namespace FactoryStories\Providers;

use Illuminate\Support\ServiceProvider;
use FactoryStories\Commands\StoryMakeCommand;

class StoryFactoryServiceProvider extends ServiceProvider
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
