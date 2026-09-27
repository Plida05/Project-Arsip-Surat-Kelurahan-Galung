<?php

namespace App\Filament\Admin\Resources\KategoriSurats\Pages;

use App\Filament\Admin\Resources\KategoriSurats\KategoriSuratResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKategoriSurats extends ListRecords
{
    protected static string $resource = KategoriSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
