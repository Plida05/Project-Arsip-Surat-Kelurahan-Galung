<?php

namespace App\Filament\Admin\Resources\ArsipSurats\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class ArsipSuratForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('jenis')
                    ->label('Jenis Surat')
                    ->options([
                        'masuk' => 'Surat Masuk',
                        'keluar' => 'Surat Keluar',
                    ])
                    ->default('masuk')
                    ->required()
                    ->live()
                    ->columnSpanFull(),

                Select::make('kategori_id')
                    ->label('Kategori Surat')
                    ->relationship('kategori', 'nama')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live(),

                TextInput::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Nomor surat ini sudah terdaftar. Gunakan nomor lain.',
                    ])
                    ->suffixAction(
                        Action::make('generateNomor')
                            ->label('Generate')
                            ->icon('heroicon-o-sparkles')
                            ->color('warning')
                            ->action(function (Set $set, Get $get) {
                                $nomorBaru = \App\Models\ArsipSurat::generateNomorSurat($get('kategori_id'));
                                $set('nomor_surat', $nomorBaru);
                            })
                    ),

                DatePicker::make('tanggal_surat')
                    ->label('Tanggal Surat')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y'),

                TextInput::make('asal')
                    ->label('Asal Surat (Pengirim)')
                    ->visible(fn (Get $get) => $get('jenis') === 'masuk')
                    ->required(fn (Get $get) => $get('jenis') === 'masuk')
                    ->maxLength(255),

                TextInput::make('tujuan')
                    ->label('Tujuan Surat (Penerima)')
                    ->visible(fn (Get $get) => $get('jenis') === 'keluar')
                    ->required(fn (Get $get) => $get('jenis') === 'keluar')
                    ->maxLength(255),

                DatePicker::make('tanggal_terima')
                    ->label('Tanggal Diterima')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->afterOrEqual('tanggal_surat')
                    ->validationMessages([
                        'after_or_equal' => 'Tanggal diterima tidak boleh lebih awal dari tanggal surat.',
                    ]),

                TextInput::make('perihal')
                    ->label('Perihal')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->rows(3)
                    ->columnSpanFull(),

                FileUpload::make('file_surat')
                    ->label('File Surat (PDF)')
                    ->disk('public')
                    ->directory('arsip-surat')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(5120)
                    ->helperText('Format PDF, maksimal 5MB')
                    ->columnSpanFull(),

                Hidden::make('user_id')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
