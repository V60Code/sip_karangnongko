<?php

namespace App\Filament\Resources\DailyCheckResource\Pages;

use App\Filament\Resources\DailyCheckResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;

class EditDailyCheck extends EditRecord
{
    protected static string $resource = DailyCheckResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
