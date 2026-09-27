<?php

namespace App\Filament\Admin\Widgets;

use App\Models\ArsipSurat;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class SuratChart extends ChartWidget
{
    protected ?string $heading = 'Statistik Surat 6 Bulan Terakhir';

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $bulanLabels = [];
        $dataMasuk = [];
        $dataKeluar = [];

        // 6 bulan terakhir
        for ($i = 5; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $bulanLabels[] = $bulan->isoFormat('MMM Y');

            $dataMasuk[] = ArsipSurat::where('jenis', 'masuk')
                ->whereYear('tanggal_surat', $bulan->year)
                ->whereMonth('tanggal_surat', $bulan->month)
                ->count();

            $dataKeluar[] = ArsipSurat::where('jenis', 'keluar')
                ->whereYear('tanggal_surat', $bulan->year)
                ->whereMonth('tanggal_surat', $bulan->month)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Surat Masuk',
                    'data' => $dataMasuk,
                    'backgroundColor' => 'rgba(34, 197, 94, 0.7)',
                    'borderColor' => 'rgb(34, 197, 94)',
                ],
                [
                    'label' => 'Surat Keluar',
                    'data' => $dataKeluar,
                    'backgroundColor' => 'rgba(245, 158, 11, 0.7)',
                    'borderColor' => 'rgb(245, 158, 11)',
                ],
            ],
            'labels' => $bulanLabels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}
