<?php

namespace App\Filament\Admin\Resources\Activities\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ActivitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('causer.name')
                    ->label('Petugas')
                    ->placeholder('Sistem')
                    ->badge()
                    ->color('info'),

                TextColumn::make('description')
                    ->label('Aktivitas')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('subject_type')
                    ->label('Data')
                    ->formatStateUsing(fn ($state) => class_basename($state))
                    ->badge()
                    ->color('gray'),

                TextColumn::make('subject_id')
                    ->label('ID Data')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('event')
                    ->label('Aksi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'created' => 'Dibuat',
                        'updated' => 'Diubah',
                        'deleted' => 'Dihapus',
                        default => $state,
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('event')
                    ->label('Jenis Aksi')
                    ->options([
                        'created' => 'Dibuat',
                        'updated' => 'Diubah',
                        'deleted' => 'Dihapus',
                    ]),
            ])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
