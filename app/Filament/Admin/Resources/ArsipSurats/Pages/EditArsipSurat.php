<?php

namespace App\Filament\Admin\Resources\ArsipSurats\Pages;

use App\Filament\Admin\Resources\ArsipSurats\ArsipSuratResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditArsipSurat extends EditRecord
{
    protected static string $resource = ArsipSuratResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
