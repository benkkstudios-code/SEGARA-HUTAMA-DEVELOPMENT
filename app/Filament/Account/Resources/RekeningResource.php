<?php

namespace App\Filament\Account\Resources;

use Filament\Tables;
use App\Models\Invoice;
use App\Models\Indobank;
use App\Models\Rekening;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Filament\Account\Resources\RekeningResource\Pages;

class RekeningResource extends Resource
{
    protected static ?string $model = Rekening::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Pengaturan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('bank')
                    ->required()
                    ->label('Bank')
                    ->options(Indobank::all()->pluck('nama', 'nama'))

                    ->placeholder('Pilih bank')
                    ->required()
                    ->searchable(),
                TextInput::make('cabang')->label('Swift Code')->placeholder('BMRIIDJA'),
                TextInput::make('pemilik')->label('Nama Pemilik Rekening')->required(),
                TextInput::make('nomor')->label('Nomor Rekening')
                    ->prefixIcon('heroicon-s-credit-card')
                    ->stripCharacters('-')
                    ->numeric()
                    ->required()
                    ->mask(RawJs::make(<<<'JS'
                         '9999-9999-9999-9999'
                    JS))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bank')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('pemilik')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nomor')->searchable()->sortable()->formatStateUsing(fn(string $state): string => wordwrap($state, 4, '-', true)),
            ])
            ->defaultSort('bank', 'ASC')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(fn($record) => 'Apakah Kamu Sudah Yakin?')
                    ->modalDescription(fn($record) => 'Menghapus rekening akan menghapus invoice yang sudah di input menggunakan rekening ini')
                    ->after(function (Rekening $record) {
                        Invoice::where('rekening', $record->id)->delete();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListRekenings::route('/'),
            'create' => Pages\CreateRekening::route('/create'),
            'edit' => Pages\EditRekening::route('/{record}/edit'),
        ];
    }
}
