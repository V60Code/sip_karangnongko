<?php

namespace App\Filament\Pages; // 1. Namespace diubah ke App\Filament\Pages

use Filament\Pages\Page;
// 2. Sesuaikan path 'use' statement untuk widget Anda
// Ini mengasumsikan widget tetap di direktori resource sebelumnya.
use App\Filament\Resources\LaporanGlobalResource\Widgets\KambingTableWidget;
use App\Filament\Resources\LaporanGlobalResource\Widgets\AbsensiTableWidget;

class LaporanGlobalPage extends Page
{
    // Properti untuk navigasi (opsional, tapi disarankan)
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar'; // Ikon untuk menu
    protected static ?string $navigationLabel = 'Laporan Global'; // Label untuk menu
    protected static ?string $navigationGroup = 'Laporan & Analitik'; // Grup menu
    protected static ?int $navigationSort = 1; // Urutan di grup menu

    // Properti untuk halaman
    protected static ?string $title = 'Laporan Global Kambing dan Absensi'; // Judul halaman
    protected static string $view = 'filament.pages.laporan-global-page'; // 3. Path ke file Blade view
                                                                         // Sesuaikan jika view Anda ada di tempat lain.
                                                                         // Jika Anda membuat view baru di resources/views/filament/pages/laporan-global-page.blade.php
                                                                         // maka 'filament.pages.laporan-global-page' sudah benar.

    // Slug untuk URL (opsional, akan digenerate otomatis jika tidak ada)
    // protected static ?string $slug = 'laporan-global-semua-user';


    // Method untuk menampilkan widget di bagian atas halaman
    protected function getHeaderWidgets(): array
    {
        return [
            KambingTableWidget::class,
            AbsensiTableWidget::class,
        ];
    }

    /**
     * Anda bisa menambahkan properti atau method lain sesuai kebutuhan halaman mandiri Anda.
     * Misalnya, jika halaman ini memerlukan otorisasi khusus:
     */
    // public static function canAccess(): bool
    // {
    //     return auth()->check(); // Contoh: hanya user yang login bisa akses
    // }
}