<?php

namespace App\Providers;

use App\Models\Goat; // Sesuaikan jika path Model Goat Anda berbeda
use App\Policies\GoatPolicy; // Sesuaikan jika path Policy Anda berbeda
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate; // Pastikan ini ada

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy', // Contoh bawaan
        Goat::class => GoatPolicy::class, // Daftarkan GoatPolicy Anda di sini
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}