<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\ArsipSurats\ArsipSuratResource;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AksiCepat extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected int|array|null $columns = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Catat Surat Masuk', '+ Tambah Surat Masuk')
                ->description('Input surat masuk baru ke arsip')
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color('success')
                ->url(ArsipSuratResource::getUrl('create')),

            Stat::make('Catat Surat Keluar', '+ Tambah Surat Keluar')
                ->description('Input surat keluar baru ke arsip')
                ->descriptionIcon('heroicon-m-arrow-up-tray')
                ->color('warning')
                ->url(ArsipSuratResource::getUrl('create')),
        ];
    }
}
