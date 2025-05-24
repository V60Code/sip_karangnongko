<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GoatResource\Pages;
use App\Models\Goat;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class GoatResource extends Resource
{
    protected static ?string $model = Goat::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Data Kambing'; // ✅ Ubah jadi lebih profesional
    protected static ?string $pluralLabel = 'Kambing';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('farm_id')
                ->label('Peternakan')
                ->relationship('farm', 'name')
                // Default farm_id should be set automatically based on the user's farm
                ->default(fn () => auth()->user()->farm_id)
                ->disabled(fn () => auth()->user()->role !== 'admin') // Only allow admin to change farm
                ->required(),

            // Nomor tag tidak perlu diinput manual, jadi disembunyikan
            TextInput::make('tag_number')
                ->label('Nomor Tag')
                ->disabled()
                ->hidden()
                ->dehydrated(),

            Select::make('gender')
                ->label('Jenis Kelamin')
                ->options([
                    'jantan' => 'Jantan',
                    'betina' => 'Betina',
                ])
                ->required(),

            TextInput::make('type')
                ->label('Jenis Kambing')
                ->required(),

            DatePicker::make('birth_date')
                ->label('Tanggal Lahir'),

            TextInput::make('weight')
                ->label('Berat (kg)')
                ->numeric()
                ->suffix('kg'),

            Textarea::make('notes')
                ->label('Catatan')
                ->rows(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tag_number')->label('Nomor Tag')->searchable(),
                TextColumn::make('type')->label('Jenis Kambing'),
                TextColumn::make('gender')->label('Jenis Kelamin'),
                TextColumn::make('birth_date')->label('Tgl Lahir')->date(),
                TextColumn::make('weight')->label('Berat')->suffix(' kg'),
                TextColumn::make('farm.name')->label('Peternakan')->sortable(),
                TextColumn::make('created_at')->label('Dibuat')->dateTime(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        // Admin can see all farms, non-admin will only see their own farm
        if (auth()->user()->role === 'admin') {
            return parent::getEloquentQuery();
        }

        // Non-admin will only see the farm assigned to them
        return parent::getEloquentQuery()->where('farm_id', auth()->user()->farm_id);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGoats::route('/'),
            'create' => Pages\CreateGoat::route('/create'),
            'edit' => Pages\EditGoat::route('/{record}/edit'),
        ];
    }
}
