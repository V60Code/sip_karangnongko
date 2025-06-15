<?php

namespace App\Filament\Resources\LaporanGlobalResource\Pages;

use App\Filament\Resources\LaporanGlobalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaporanGlobals extends ListRecords
{
    protected static string $resource = LaporanGlobalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
