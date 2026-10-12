<?php

namespace App\Filament\Admin\Resources\KategoriSurats\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KategoriSuratsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('nama')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make('kode_klasifikasi')
                    ->label('Kode Klasifikasi')
                    ->badge()
                    ->color('info')
                    ->placeholder('-'),

                TextColumn::make('arsip_surats_count')
                    ->label('Jumlah Surat')
                    ->counts('arsipSurats')
                    ->badge()
                    ->color('success')
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('kode', 'asc')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->before(function (DeleteAction $action, $record) {
                        if ($record->arsipSurats()->count() > 0) {
                            Notification::make()
                                ->title('Kategori Tidak Bisa Dihapus')
                                ->body('Kategori ini masih digunakan oleh ' . $record->arsipSurats()->count() . ' arsip surat.')
                                ->danger()
                                ->send();

                            $action->cancel();
                        }
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->before(function (DeleteBulkAction $action, $records) {
                            foreach ($records as $record) {
                                if ($record->arsipSurats()->count() > 0) {
                                    Notification::make()
                                        ->title('Sebagian Kategori Tidak Bisa Dihapus')
                                        ->body('Kategori "' . $record->nama . '" masih digunakan oleh ' . $record->arsipSurats()->count() . ' arsip surat.')
                                        ->danger()
                                        ->send();

                                    $action->cancel();
                                    break;
                                }
                            }
                        }),
                ]),
            ]);
    }
}
