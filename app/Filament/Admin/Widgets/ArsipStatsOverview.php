<?php

namespace App\Filament\Admin\Widgets;

use App\Models\ArsipSurat;
use App\Models\KategoriSurat;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ArsipStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total = ArsipSurat::count();
        $masuk = ArsipSurat::where('jenis', 'masuk')->count();
        $keluar = ArsipSurat::where('jenis', 'keluar')->count();
        $kategori = KategoriSurat::count();

        return [
            Stat::make('Total Arsip Surat', $total)
                ->description('Semua surat terarsip')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('primary'),

            Stat::make('Surat Masuk', $masuk)
                ->description('Surat dari instansi lain')
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color('success'),

            Stat::make('Surat Keluar', $keluar)
                ->description('Surat dari kelurahan')
                ->descriptionIcon('heroicon-m-arrow-up-tray')
                ->color('warning'),

            Stat::make('Kategori Surat', $kategori)
                ->description('Jenis klasifikasi')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),
        ];
    }
}
