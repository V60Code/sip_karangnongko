<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class, // Tambahkan baris ini
    App\Providers\Filament\AdminPanelProvider::class,
];