<?php

namespace Fawad\LaravelComments;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Fawad\LaravelComments\Http\Livewire\Comment;
use Fawad\LaravelComments\Http\Livewire\CommentForm;
use Fawad\LaravelComments\Http\Livewire\CommentList;
use Fawad\LaravelComments\Http\Livewire\CommentVote;

class LaravelCommentsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the package services.
     */
    public function boot()
    {
        // Load package resources
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'comments');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Publish config
        $this->publishes([
            __DIR__ . '/../config/comments.php' => config_path('comments.php'),
        ], 'config');

        // Publish views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/comments'),
        ], 'views');

        // Register Livewire components
        Livewire::component('comments-form', CommentForm::class);
        Livewire::component('comments-list', CommentList::class);
        Livewire::component('comment-vote', CommentVote::class);
        Livewire::component('coments-form', CommentForm::class);
        Livewire::component('comments', Comment::class);
    }

    /**
     * Register the package services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/comments.php', 'comments');

        $this->app->singleton('comments', function () {
            return new \Fawad\Comments\Services\CommentService;
        });

    }
}
