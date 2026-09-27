<?php

namespace App\Filament\Admin\Resources\KategoriSurats\Pages;

use App\Filament\Admin\Resources\KategoriSurats\KategoriSuratResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKategoriSurat extends EditRecord
{
    protected static string $resource = KategoriSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
