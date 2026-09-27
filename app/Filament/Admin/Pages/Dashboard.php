<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Selamat Datang';

    protected static ?string $navigationLabel = 'Dashboard';

    public function getHeading(): string
    {
        return 'Selamat Datang di Sistem Pengarsipan Surat';
    }

    public function getSubheading(): ?string
    {
        return 'Kelurahan Galung — Kelola arsip surat masuk dan keluar dengan mudah.';
    }
}
