<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession; // Pastikan ini juga di-import jika digunakan di array middleware
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Pages\Dashboard;       // Pastikan path ke Dashboard Anda benar dan di-import
use App\Filament\Pages\LaporanGlobalPage;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets; // Import Widgets jika Anda menggunakannya
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources') // Biarkan ini untuk Resources
            // ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages') // <-- DIKOMENTARI (SUDAH BENAR)
            ->pages([ // Daftarkan SEMUA halaman yang ingin Anda tampilkan secara eksplisit
                Dashboard::class,       // Dashboard Anda
                LaporanGlobalPage::class, // <-- UNCOMMENT INI JIKA ANDA PUNYA HALAMAN LAPORAN GLOBAL
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets') // Biarkan ini jika Anda punya widget
            ->widgets([
                // Komentari widget bawaan atau custom jika tidak yakin atau untuk tes lebih lanjut jika masalah berlanjut
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class, // Pastikan ini ada jika panel Anda menggunakan sesi
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}