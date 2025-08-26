<?php

use Illuminate\Support\Facades\Route;

// Package routes
Route::group([
    'prefix' => 'comments',
    'as' => 'comments.',
    'middleware' => ['web', 'auth'], // Ensure only logged-in users can comment
], function () {
    // Example placeholder route (most logic is handled in Livewire components)
    Route::get('/', function () {
        return redirect()->back();
    })->name('index');
});
