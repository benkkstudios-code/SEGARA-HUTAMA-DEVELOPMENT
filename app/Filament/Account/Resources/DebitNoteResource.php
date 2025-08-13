<?php

namespace App\Filament\Account\Resources;

use Alkoumi\FilamentImageRadioButton\Forms\Components\ImageRadioGroup;
use App\Filament\Account\Resources\DebitNoteResource\Pages;
use App\Filament\Account\Resources\DebitNoteResource\RelationManagers;
use App\Models\DebitNote;
use App\Models\Perusahaan;
use App\Models\Rekening;
use App\Models\Stempels;
use Carbon\Carbon;
use DateTime;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;

class DebitNoteResource extends Resource
{
    protected static ?string $model = DebitNote::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Keuangan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('perusahaan')
                    ->required()
                    ->options(Perusahaan::all()->pluck('nama', 'id'))
                    ->placeholder('Pilih Perusahaan')
                    ->required()
                    ->searchable(),
                Select::make('rekening')
                    ->required()
                    ->options(Rekening::all()->pluck('pemilik', 'id'))
                    ->placeholder('Pilih Rekening')
                    ->required()
                    ->searchable(),
                TextInput::make('transportasi')->placeholder('MT. ES JEWEL '),
                TextInput::make('lokasi_muat')->label('PELABUHAN MUAT')->required()->placeholder('TABALONG'),
                TextInput::make('pib')->label('Nomor PIB')->numeric()->required()->placeholder('000045'),

                TextInput::make('pengirim')->label('Shipper')->required()->placeholder('PT. Segara Hutama Karya Exim'),

                Section::make('URAIAN')

                    ->schema([
                        Repeater::make('uraian')
                            ->schema([
                                TextInput::make('keterangan'),
                                TextInput::make('tonase')->numeric(),
                                TextInput::make('jumlah')
                                    ->prefix('Rp.')
                                    ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2)
                                    ->required(),
                            ])
                            ->columns(3),

                    ]),
                Section::make('Pilih Stempel')
                    ->schema([
                        ImageRadioGroup::make('stempel')
                            ->disk('public')
                            ->required()
                            ->animation(true)
                            ->options(fn() => Stempels::pluck('preview', 'image')->toArray())->columnSpanFull()
                    ]),

                DatePicker::make('tanggal')->Label('Tanggal Pembuatan Invoice')->default(now())->required(),
                DatePicker::make('tempo')->Label('Tanggal Jatuh Tempo')->default(now())->required(),
                TextInput::make('nomor')->label("NO. DEBIT NOTE")->default("0027-153/MM14" . date("mdY"))->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor')->label('#NO')->limit(10)->searchable()->sortable(),
                Tables\Columns\TextColumn::make('pib')->label('PIB')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('tanggal')->searchable()->sortable()->getStateUsing(
                    function ($record) {
                        return Carbon::parse(DateTime::createFromFormat('Y-m-d', $record->tanggal))->translatedFormat('l, d M Y');
                    }
                ),
                Tables\Columns\TextColumn::make('transportasi')->label('Transport')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('lokasi_muat')->label('Lokasi')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('pengirim')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('total')->searchable()->sortable()->getStateUsing(
                    function ($record) {
                        return 'Rp.' . str_replace(',00', '', number_format($record->total, 2, ",", "."));
                    }
                ),
                // Tables\Columns\BadgeColumn::make('status')
                //     ->action(function ($state, $record) {
                //         $invoice = DebitNote::find($record->id);
                //         if ($invoice->status == 'Belum Dibayar') {
                //             $invoice->status = 'Sudah Dibayar';
                //         } else {
                //             $invoice->status = 'Belum Dibayar';
                //         }
                //         $invoice->save();
                //         // return Redirect::to($invoice);
                //     })
                //     ->colors([
                //         'primary',

                //         'success' => 'Sudah Dibayar',
                //         'danger' => 'Belum Dibayar',
                //     ])

            ])->defaultSort('id', 'desc')
            ->filters([])
            ->actions([
                Action::make('print')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->url(fn(DebitNote $record): string => route('print.debit', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListDebitNotes::route('/'),
            'create' => Pages\CreateDebitNote::route('/create'),
            'edit' => Pages\EditDebitNote::route('/{record}/edit'),
        ];
    }
}
