<?php

namespace App\Filament\Admin\Widgets;

use App\Models\ArsipSurat;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class SuratJenisChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Perbandingan Surat Masuk & Keluar';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $tahun = (int) ($this->filters['tahun'] ?? date('Y'));

        $masuk = ArsipSurat::where('jenis', 'masuk')
            ->whereYear('tanggal_surat', $tahun)
            ->count();

        $keluar = ArsipSurat::where('jenis', 'keluar')
            ->whereYear('tanggal_surat', $tahun)
            ->count();

        return [
            'datasets' => [
                [
                    'data' => [$masuk, $keluar],
                    'backgroundColor' => [
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                    ],
                    'borderColor' => [
                        'rgb(34, 197, 94)',
                        'rgb(245, 158, 11)',
                    ],
                ],
            ],
            'labels' => ['Surat Masuk', 'Surat Keluar'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
