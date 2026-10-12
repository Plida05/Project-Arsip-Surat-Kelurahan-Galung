<?php

namespace App\Filament\Admin\Widgets;

use App\Models\ArsipSurat;
use App\Models\KategoriSurat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ArsipStatsOverview extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $tahun = (int) ($this->filters['tahun'] ?? date('Y'));

        $total = ArsipSurat::whereYear('tanggal_surat', $tahun)->count();
        $masuk = ArsipSurat::where('jenis', 'masuk')->whereYear('tanggal_surat', $tahun)->count();
        $keluar = ArsipSurat::where('jenis', 'keluar')->whereYear('tanggal_surat', $tahun)->count();
        $kategori = KategoriSurat::count();

        return [
            Stat::make('Total Arsip Surat', $total)
                ->description('Semua surat tahun ' . $tahun)
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('primary'),

            Stat::make('Surat Masuk', $masuk)
                ->description('Dari instansi lain')
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color('success'),

            Stat::make('Surat Keluar', $keluar)
                ->description('Dari kelurahan')
                ->descriptionIcon('heroicon-m-arrow-up-tray')
                ->color('warning'),

            Stat::make('Kategori Surat', $kategori)
                ->description('Jenis klasifikasi')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),
        ];
    }
}
