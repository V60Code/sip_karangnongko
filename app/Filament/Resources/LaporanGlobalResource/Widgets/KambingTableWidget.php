<?php

namespace App\Filament\Resources\LaporanGlobalResource\Widgets;

use App\Models\Goat; // DIUBAH ke Goat
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class KambingTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Data Semua Ternak Kambing'; // Judul bisa disesuaikan

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Menggunakan model Goat dan memuat relasi user serta farm
                Goat::query()->with(['user', 'farm'])
            )
            ->columns([
                Tables\Columns\TextColumn::make('tag_number')->label('No. Ternak')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('type')->label('Jenis Kambing')->sortable()->searchable()->default('-'),
                Tables\Columns\TextColumn::make('gender')->label('Kelamin')->sortable()->default('-'), // Ini adalah Enum, akan ditampilkan sebagai value-nya
                Tables\Columns\TextColumn::make('birth_date')->label('Tgl Lahir')->date('d M Y')->sortable()->default('-'),
                Tables\Columns\TextColumn::make('weight')->label('Bobot (Kg)')->suffix(' Kg')->sortable()->default('-'),
                Tables\Columns\TextColumn::make('user.name')->label('Pemilik (User)')
                    ->default('N/A')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('farm.name')->label('Asal Peternakan')
                    ->default('N/A')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('notes')->label('Catatan')
                    ->limit(30) // Batasi tampilan awal
                    ->tooltip(fn($record) => $record->notes) // Tampilkan penuh saat hover
                    ->default('-'),
            ])
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