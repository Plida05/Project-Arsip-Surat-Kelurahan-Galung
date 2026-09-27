<?php

namespace App\Filament\Admin\Resources\ArsipSurats;

use App\Filament\Admin\Resources\ArsipSurats\Pages\CreateArsipSurat;
use App\Filament\Admin\Resources\ArsipSurats\Pages\EditArsipSurat;
use App\Filament\Admin\Resources\ArsipSurats\Pages\ListArsipSurats;
use App\Filament\Admin\Resources\ArsipSurats\Schemas\ArsipSuratForm;
use App\Filament\Admin\Resources\ArsipSurats\Tables\ArsipSuratsTable;
use App\Models\ArsipSurat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ArsipSuratResource extends Resource
{
    protected static ?string $model = ArsipSurat::class;
    protected static ?string $modelLabel = 'Arsip Surat';
    protected static ?string $pluralModelLabel = 'Arsip Surat';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'nomor_surat';

    public static function form(Schema $schema): Schema
    {
        return ArsipSuratForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ArsipSuratsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArsipSurats::route('/'),
            'create' => CreateArsipSurat::route('/create'),
            'edit' => EditArsipSurat::route('/{record}/edit'),
        ];
    }
}
