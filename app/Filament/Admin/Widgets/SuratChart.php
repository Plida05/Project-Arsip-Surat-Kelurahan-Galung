<?php

namespace App\Filament\Admin\Widgets;

use App\Models\ArsipSurat;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class SuratChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected ?string $heading = 'Statistik Surat per Bulan';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $tahun = (int) ($this->filters['tahun'] ?? date('Y'));

        $bulanLabels = [];
        $dataMasuk = [];
        $dataKeluar = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $tanggal = Carbon::create($tahun, $bulan, 1);
            $bulanLabels[] = $tanggal->isoFormat('MMM');

            $dataMasuk[] = ArsipSurat::where('jenis', 'masuk')
                ->whereYear('tanggal_surat', $tahun)
                ->whereMonth('tanggal_surat', $bulan)
                ->count();

            $dataKeluar[] = ArsipSurat::where('jenis', 'keluar')
                ->whereYear('tanggal_surat', $tahun)
                ->whereMonth('tanggal_surat', $bulan)
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
}
