<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

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
        // Force HTTPS in production
        if (app()->environment('production') || request()->isSecure()) {
            URL::forceScheme('https');
            
            // Configure Livewire for HTTPS
            Livewire::setScriptRoute(function ($handle) {
                return Route::get('/livewire/livewire.js', $handle);
            });
            
            // Force HTTPS for assets
            URL::forceRootUrl(config('app.url'));
        }
        
        // Optimasi untuk production
        if (app()->environment('production')) {
            // Disable lazy loading untuk mencegah N+1 queries
            Model::preventLazyLoading();
            
            // Disable accessing missing attributes
            Model::preventAccessingMissingAttributes();
            
            // Disable silently discarding attributes
            Model::preventSilentlyDiscardingAttributes();
        }
        
        // Query monitoring untuk development
        if (app()->environment('local')) {
            DB::listen(function ($query) {
                if ($query->time > 100) { // Query lebih dari 100ms
                    Log::warning('Slow Query Detected', [
                        'sql' => $query->sql,
                        'bindings' => $query->bindings,
                        'time' => $query->time . 'ms'
                    ]);
                }
            });
        }
        
        // Set default string length untuk MySQL
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);
    }
}
