<?php

namespace App\Filament\Resources\GoatResource\Pages;

use App\Filament\Resources\GoatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder; // Penting
use Illuminate\Support\Facades\Auth; // Penting

class ListGoats extends ListRecords
{
    protected static string $resource = GoatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // Modifikasi query untuk menampilkan data
    protected function getTableQuery(): Builder
    {
        $user = Auth::user();
        if ($user->role === 'admin') { // Asumsi Anda punya kolom 'role' di tabel users
            return parent::getTableQuery(); // Admin melihat semua
        }
        // User selain admin hanya melihat kambing miliknya
        return parent::getTableQuery()->where('user_id', $user->id);
    }
}