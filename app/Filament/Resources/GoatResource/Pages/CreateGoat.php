<?php

namespace App\Filament\Resources\GoatResource\Pages;

use App\Filament\Resources\GoatResource;
use App\Models\Goat;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateGoat extends CreateRecord
{
    protected static string $resource = GoatResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Tentukan farm_id berdasarkan role user (non-admin)
        if (Auth::user()->role !== 'admin') {
            $data['farm_id'] = Auth::user()->farm_id;
        }

        // Inisialisasi prefix berdasarkan nama kandang
        $farmCode = match ($data['farm_id']) {
            1 => 'KB', // Kandang Barat (misal id = 1)
            2 => 'KT', // Kandang Timur (misal id = 2)
            default => 'XX',
        };

        // Ambil nomor urut terakhir dari tag_number dengan prefix yang sama
        $lastGoat = Goat::where('farm_id', $data['farm_id'])
            ->where('tag_number', 'like', "{$farmCode}%")
            ->orderByDesc('tag_number')
            ->first();

        $lastNumber = 0;

        if ($lastGoat && preg_match('/\d+$/', $lastGoat->tag_number, $matches)) {
            $lastNumber = (int)$matches[0];
        }

        $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        $data['tag_number'] = $farmCode . $nextNumber;

        return $data;
    }
}
