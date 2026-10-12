<?php

namespace App\Filament\Admin\Resources\KategoriSurats\Pages;

use App\Filament\Admin\Resources\KategoriSurats\KategoriSuratResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditKategoriSurat extends EditRecord
{
    protected static string $resource = KategoriSuratResource::class;

    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->before(function (DeleteAction $action, $record) {
                    if ($record->arsipSurats()->count() > 0) {
                        Notification::make()
                            ->title('Kategori Tidak Bisa Dihapus')
                            ->body('Kategori ini masih digunakan oleh ' . $record->arsipSurats()->count() . ' arsip surat. Pindahkan atau hapus surat terlebih dahulu.')
                            ->danger()
                            ->send();

                        $action->cancel();
                    }
                }),
        ];
    }
}
