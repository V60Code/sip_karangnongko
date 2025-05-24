<?php

namespace App\Filament\Resources\DailyCheckResource\Pages;

use App\Filament\Resources\DailyCheckResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateDailyCheck extends CreateRecord
{
    protected static string $resource = DailyCheckResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }
}
