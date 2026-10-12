<?php

namespace App\Filament\Admin\Resources\KategoriSurats\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class KategoriSuratForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode')
                    ->label('Kode')
                    ->required()
                    ->maxLength(10)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Kode ini sudah digunakan. Gunakan kode lain.',
                    ])
                    ->helperText('Contoh: UND, PRM, EDR'),

                TextInput::make('kode_klasifikasi')
                    ->label('Kode Klasifikasi')
                    ->required()
                    ->maxLength(10)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Kode klasifikasi ini sudah digunakan. Gunakan kode lain.',
                    ])
                    ->placeholder('Contoh: 005, 010, 020')
                    ->helperText('Kode standar arsip pemerintahan. Harus unik.'),

                TextInput::make('nama')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
