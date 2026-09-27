<?php

namespace App\Filament\Admin\Resources\ArsipSurats\Pages;

use App\Filament\Admin\Resources\ArsipSurats\ArsipSuratResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArsipSurats extends ListRecords
{
    protected static string $resource = ArsipSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
