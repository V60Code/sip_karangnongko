<?php

namespace App\Filament\Resources\LaporanGlobalResource\Widgets;

use App\Models\DailyCheck; // DIUBAH ke DailyCheck
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class AbsensiTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Log Pemeriksaan Harian Global'; // Judul disesuaikan

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Menggunakan model DailyCheck, memuat relasi user, dan menghitung relasi goats
                DailyCheck::query()->with('user')->latest('check_date')
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Nama Pelaksana')->sortable()->searchable()->default('N/A'),
                Tables\Columns\TextColumn::make('check_date')->label('Tanggal Pemeriksaan')->date('d M Y')->sortable(),
                Tables\Columns\TextColumn::make('notes')->label('Catatan Pemeriksaan')
                    ->limit(40) // Batasi panjang teks yang ditampilkan di tabel
                    ->tooltip(fn ($record) => $record->notes) // Tampilkan teks penuh saat dihover
                    ->default('-'),
                // Tables\Columns\TextColumn::make('goats_count')->counts('goats')->label('Jml Kambing Diperiksa')->sortable(),
            ])
            ->defaultSort('check_date', 'desc')
            ->filters([
                // Tambahkan filter jika perlu
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}