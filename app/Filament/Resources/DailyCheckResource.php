<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyCheckResource\Pages;
use App\Models\DailyCheck;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class DailyCheckResource extends Resource
{
    protected static ?string $model = DailyCheck::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Absensi Harian';

    public static function form(Form $form): Form
    {
        return $form->schema([
            DatePicker::make('check_date')
                ->label('Tanggal')
                ->default(now())
                ->required(),

            TextInput::make('any_sick_goat')
                ->label('Jumlah Kambing Sakit')
                ->numeric()
                ->minValue(0)
                ->required(),

            Textarea::make('notes')
                ->label('Catatan')
                ->rows(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('check_date')->label('Tanggal'),
                TextColumn::make('any_sick_goat')->label('Jumlah Kambing Sakit'),
                TextColumn::make('notes')->label('Catatan')->limit(20),
            ])
            ->defaultSort('check_date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDailyCheck::route('/'),
            'create' => Pages\CreateDailyCheck::route('/create'),
            'edit' => Pages\EditDailyCheck::route('/{record}/edit'),
        ];
    }
}
