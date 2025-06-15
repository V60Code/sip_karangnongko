<?php

namespace App\Filament\Resources\LaporanGlobalResource\Pages;

use App\Filament\Resources\LaporanGlobalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporanGlobal extends EditRecord
{
    protected static string $resource = LaporanGlobalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
