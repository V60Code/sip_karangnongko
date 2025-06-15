<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyCheckResource\Pages;
use App\Models\DailyCheck;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select; // Pastikan ini di-import
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Models\Goat; // Untuk relasi di form Select
use Illuminate\Database\Eloquent\Builder; // Untuk getEloquentQuery
use Illuminate\Support\Facades\Auth; // Untuk getEloquentQuery

class DailyCheckResource extends Resource
{
    protected static ?string $model = DailyCheck::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Data Absen Harian';
    protected static ?string $pluralLabel = 'Absen Harian';
    protected static ?string $modelLabel = 'Absen Harian';

    // Atur urutan navigasi
    protected static ?int $navigationSort = 2; // Setelah Dashboard

    public static function form(Form $form): Form
    {
        return $form->schema([
            DatePicker::make('check_date')
                ->label('Tanggal Pengecekan')
                ->default(now())
                ->required()
                ->maxDate(now()), // Tidak bisa absen untuk masa depan
            Select::make('user_id')
                ->relationship('user', 'name')
                ->label('Dicek Oleh')
                ->default(auth()->id())
                ->disabled() // Diisi otomatis, tidak perlu diubah manual
                ->required(),
            Textarea::make('notes')
                ->label('Catatan Umum Pengecekan')
                ->rows(3)
                ->columnSpanFull(),
            // Select::make('goats') // Menggunakan 'goats' sesuai nama relasi many-to-many
            //     ->label('Kambing yang Dicek')
            //     ->multiple()
            //     ->relationship(
            //         name: 'goats', // Nama relasi di model DailyCheck
            //         titleAttribute: 'tag_number', // Menampilkan tag_number kambing sebagai opsi
            //         modifyQueryUsing: fn (Builder $query) => auth()->user()->role === 'admin' ? null : $query->where('farm_id', auth()->user()->farm_id) // Filter kambing berdasarkan farm user jika bukan admin
            //     )
            //     ->preload()
            //     ->searchable(['tag_number', 'name']) // Memungkinkan pencarian berdasarkan tag_number atau nama kambing
            //     ->helperText('Pilih semua kambing yang dilakukan pengecekan pada tanggal ini.'),
            // // Kolom 'any_sick_goat' yang sebelumnya ada di form Anda,
            // sebaiknya dihilangkan jika kondisi sakit akan dicatat per kambing (di Data Kambing)
            // atau melalui fitur lain. Jika masih diperlukan, Anda bisa menambahkannya kembali.
            // TextInput::make('any_sick_goat')
            //     ->label('Jumlah Kambing Sakit (Manual)')
            //     ->numeric()
            //     ->minValue(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('check_date')->label('Tanggal Cek')->date()->sortable(),
                TextColumn::make('user.name')->label('Dicek Oleh')->searchable()->sortable(),
                // TextColumn::make('goats_count')->counts('goats')->label('Jml Kambing Dicek')->sortable(),
                TextColumn::make('notes')->label('Catatan')->limit(50)->searchable()->toggleable(),
                TextColumn::make('created_at')->label('Dibuat')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('check_date', 'desc')
            ->filters([
                // Anda bisa menambahkan filter berdasarkan tanggal atau user jika perlu
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->defaultPaginationPageOption(25)
            ->poll('30s')
            ->deferLoading();
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();
        
        $query = parent::getEloquentQuery()
            ->with(['user:id,name'])
            ->select(['id', 'user_id', 'check_date', 'notes', 'created_at', 'updated_at']);
        
        // Admin bisa melihat semua data absen
        if ($user->role === 'admin') {
            return $query->orderBy('check_date', 'desc');
        }
        // Non-admin hanya melihat data absen yang mereka input
        return $query->where('user_id', $user->id)
                     ->orderBy('check_date', 'desc');
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