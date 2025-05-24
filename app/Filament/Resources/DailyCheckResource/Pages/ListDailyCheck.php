<?php

namespace App\Filament\Resources\DailyCheckResource\Pages;

use App\Filament\Resources\DailyCheckResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Actions;

class ListDailyCheck extends ListRecords
{
    protected static string $resource = DailyCheckResource::class;

    protected function getTableQuery(): Builder
    {
        $user = Auth::user();

        return DailyCheckResource::getModel()::query()
            ->when($user->role !== 'admin', fn ($query) => $query->where('user_id', $user->id));
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
