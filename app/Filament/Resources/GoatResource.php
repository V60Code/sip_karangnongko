<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GoatResource\Pages;
use App\Models\Goat;
use App\Enums\GenderEnum; // Pastikan app/Enums/GenderEnum.php ada dan benar
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
use Filament\Tables\Filters\SelectFilter; // Untuk filter berdasarkan farm
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\Farm; // Import Farm model untuk filter

class GoatResource extends Resource
{
    protected static ?string $model = Goat::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Data Kambing';
    protected static ?string $pluralLabel = 'Kambing';
    protected static ?string $modelLabel = 'Kambing';

    // Atur urutan navigasi
    protected static ?int $navigationSort = 3; // Setelah Data Absen Harian

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('farm_id')
                ->label('Peternakan')
                ->relationship('farm', 'name')
                ->disabled(fn () => Auth::user()->role !== 'admin' && Auth::user()->farm_id !== null)
                ->default(fn () => Auth::user()->farm_id ?? null)
                ->preload()
                ->reactive()
                ->required(),
            // TextInput::make('tag_number') // DIHAPUS KARENA AUTO GENERATE
            TextInput::make('type')
                ->label('Jenis Kambing')
                ->placeholder('Contoh: Etawa, Jawa Randu, dll.'),
            Select::make('gender')
                ->label('Jenis Kelamin')
                ->options(GenderEnum::asSelectArray())
                ->required(),
            DatePicker::make('birth_date')
                ->label('Tanggal Lahir')
                ->maxDate(now()),
            TextInput::make('weight')
                ->label('Berat (kg)')
                ->numeric()
                ->suffix('kg')
                ->minValue(0),
            Textarea::make('notes')
                ->label('Catatan Tambahan')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tag_number')->label('Nomor Tag')->searchable()->sortable(),
                TextColumn::make('farm.name')->label('Peternakan')->searchable()->sortable(),
                TextColumn::make('type')->label('Jenis Kambing')->searchable(),
                TextColumn::make('gender')
                    ->label('Jenis Kelamin')
                    ->formatStateUsing(fn ($state): string => $state ? GenderEnum::from($state->value)->getLabel() : '')
                    ->searchable(),
                TextColumn::make('birth_date')->label('Tgl Lahir')->date()->sortable(),
                TextColumn::make('weight')->label('Berat')->suffix(' kg')->sortable(),
                TextColumn::make('user.name')->label('Ditambahkan Oleh')->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->label('Dibuat')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->label('Diubah')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('farm_id')
                    ->label('Peternakan')
                    ->options(Farm::query()->pluck('name', 'id')->all())
                    ->visible(fn (): bool => auth()->user()->role === 'admin'),
                SelectFilter::make('gender')
                    ->options(GenderEnum::asSelectArray()),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->defaultPaginationPageOption(25)
            ->poll('60s') // Reduced polling frequency from 30s to 60s
            ->deferLoading();
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        
        $query = parent::getEloquentQuery()
            ->with(['farm:id,name', 'user:id,name'])
            ->select(['id', 'tag_number', 'gender', 'type', 'birth_date', 'weight', 'farm_id', 'user_id', 'created_at', 'updated_at'])
            ->orderBy('created_at', 'desc'); // Add default ordering for better performance
        
        // Filter berdasarkan role user
        if ($user->role !== 'admin' && $user->farm_id !== null) {
            $query->where('farm_id', $user->farm_id);
        }
        
        return $query;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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