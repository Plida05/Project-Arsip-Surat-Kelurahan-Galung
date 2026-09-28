<?php

namespace App\Filament\Admin\Resources\ArsipSurats\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ArsipSuratsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'masuk' => 'success',
                        'keluar' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'masuk' => 'Masuk',
                        'keluar' => 'Keluar',
                        default => $state,
                    })
                    ->sortable(),

                TextColumn::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('kategori.nama')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('perihal')
                    ->label('Perihal')
                    ->searchable()
                    ->limit(40)
                    ->wrap(),

                TextColumn::make('asal')
                    ->label('Asal')
                    ->searchable()
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make('tujuan')
                    ->label('Tujuan')
                    ->searchable()
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make('tanggal_surat')
                    ->label('Tgl Surat')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('tanggal_terima')
                    ->label('Tgl Terima')
                    ->date('d/m/Y')
                    ->placeholder('-')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('file_surat')
                    ->label('File')
                    ->formatStateUsing(fn ($state) => $state ? '📄 Lihat PDF' : '-')
                    ->url(fn ($record) => $record->file_surat
                        ? asset('storage/' . $record->file_surat)
                        : null)
                    ->openUrlInNewTab()
                    ->color('warning')
                    ->weight('bold')
                    ->alignCenter(),

                TextColumn::make('deleted_at')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Terhapus' : 'Aktif')
                    ->color(fn ($state) => $state ? 'danger' : 'success')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Diinput Oleh')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('tanggal_surat', 'desc')
            ->filters([
                TrashedFilter::make()
                    ->label('Status Data'),

                SelectFilter::make('jenis')
                    ->label('Jenis Surat')
                    ->options([
                        'masuk' => 'Surat Masuk',
                        'keluar' => 'Surat Keluar',
                    ]),

                SelectFilter::make('kategori_id')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                Action::make('print')
                    ->label('Print')
                    ->icon('heroicon-o-printer')
                    ->color('info')
                    ->url(fn ($record) => route('arsip.print', $record->id))
                    ->openUrlInNewTab(),
                EditAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])
            ->toolbarActions([
                Action::make('export')
                    ->label('Export CSV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn () => url('/admin/export-arsip'))
                    ->openUrlInNewTab(),
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}
