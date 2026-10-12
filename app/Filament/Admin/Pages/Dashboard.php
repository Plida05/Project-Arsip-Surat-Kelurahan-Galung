<?php

namespace App\Filament\Admin\Pages;

use App\Models\ArsipSurat;
use Filament\Forms\Components\Select;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Schema;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    public function getHeading(): string
    {
        return 'Selamat Datang di Sistem Pengarsipan Surat';
    }

    public function getSubheading(): ?string
    {
        return 'Kelurahan Galung — Kelola arsip surat masuk dan keluar dengan mudah.';
    }

    public function filtersForm(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tahun')
                    ->label('Tahun')
                    ->options(function () {
                        $years = ArsipSurat::query()
                            ->selectRaw('YEAR(tanggal_surat) as tahun')
                            ->whereNotNull('tanggal_surat')
                            ->distinct()
                            ->orderBy('tahun', 'desc')
                            ->pluck('tahun', 'tahun')
                            ->toArray();

                        $currentYear = (string) date('Y');
                        if (!isset($years[$currentYear])) {
                            $years[$currentYear] = $currentYear;
                        }

                        krsort($years);
                        return $years;
                    })
                    ->default((string) date('Y'))
                    ->selectablePlaceholder(false),
            ]);
    }
}
