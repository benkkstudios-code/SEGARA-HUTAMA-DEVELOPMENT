<?php

namespace App\Filament\Account\Resources;

use Alkoumi\FilamentImageRadioButton\Forms\Components\ImageRadioGroup;
use Closure;
use App\Filament\Account\Resources\InvoiceResource\Pages;
use App\Filament\Account\Resources\InvoiceResource\RelationManagers;
use App\Libraries\Benkkstudios;
use App\Models\Invoice;
use App\Models\Perusahaan;
use App\Models\Rekening;
use App\Models\Stempels;
use Carbon\Carbon;
use Cknow\Money\Money;
use DateTime;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Str;

use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Number;
use Pelmered\FilamentMoneyField\Forms\Components\MoneyInput;
use Tuxones\JsMoneyField\Forms\Components\JSMoneyInput;

use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Label;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Keuangan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('perusahaan')->label('Mitra Perusahaan')
                    ->required()
                    ->options(Perusahaan::all()->pluck('nama', 'id'))
                    ->placeholder('Pilih Perusahaan')
                    ->required()
                    ->searchable(),
                Select::make('rekening')
                    ->required()
                    ->options(
                        Rekening::all()->map(function ($rekening) {
                            return [
                                'value' => $rekening->id,
                                'label' => $rekening->pemilik . ' - ' . $rekening->nomor,
                            ];
                        })->pluck('label', 'value')
                    )
                    ->placeholder('Pilih Rekening')
                    ->required()
                    ->searchable(),
                TextInput::make('transportasi')->placeholder('MT. ES JEWEL ')->label('Nama Kapal'),
                TextInput::make('lokasi_muat')->label('PELABUHAN MUAT')->required()->placeholder('TABALONG'),
                TextInput::make('pib')->label('PEB/PIB')->numeric()->required()->placeholder('000045'),

                TextInput::make('pengirim')->label('Shipper')->required()->placeholder('PT. Segara Hutama Karya Exim'),

                Section::make('URAIAN')

                    ->schema([
                        Repeater::make('uraian')
                            ->schema([
                                TextInput::make('keterangan'),
                                TextInput::make('tonase')->suffix('MT'),
                                TextInput::make('jumlah')
                                    ->prefix('Rp.')
                                    ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2)
                                    ->required(),
                            ])
                            ->columns(3),

                    ]),
                Section::make('PPH & PPN')
                    ->schema([
                        Toggle::make('include_pph')->label('Include PPH')->required(),
                        Toggle::make('include_ppn')->label('Include PPN')->required(),
                    ]),
                Section::make('Pilih Stempel')
                    ->schema([
                        ImageRadioGroup::make('stempel')
                            ->disk('public')
                            ->default(5)
                            ->required()
                            ->animation(true)
                            ->options(fn() => Stempels::pluck('preview', 'image')->toArray())->columnSpanFull()
                    ]),

                DatePicker::make('tanggal')->Label('Tanggal Pembuatan Invoice')->default(now())->required(),
                DatePicker::make('tempo')->Label('Tanggal Jatuh Tempo')->default(now())->required(),
                TextInput::make('nomor')->label("NO. INVOICE")->default(Benkkstudios::createInvoiceNumber())->columnSpanFull(),
                // TextInput::make('nominal')
                //     ->prefix('Rp.')
                //     ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2)
                //     ->required()
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
                // Tables\Columns\TextColumn::make('pengirim')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('total')->searchable()->sortable()->getStateUsing(
                    function ($record) {
                        $data = Benkkstudios::calculateInvoice($record);
                        return $data['total'];
                    }
                ),
                ToggleColumn::make('include_pph')->label('Include PPH'),
                ToggleColumn::make('include_ppn')->label('Include PPN'),

                Tables\Columns\BadgeColumn::make('status')
                    ->action(function ($state, $record) {
                        $invoice = Invoice::find($record->id);
                        if ($invoice->status == 'Belum Dibayar') {
                            $invoice->status = 'Sudah Dibayar';
                        } else {
                            $invoice->status = 'Belum Dibayar';
                        }
                        $invoice->save();
                        // return Redirect::to($invoice);
                    })
                    ->colors([
                        'primary',

                        'success' => 'Sudah Dibayar',
                        'danger' => 'Belum Dibayar',
                    ])

            ])->defaultSort('id', 'desc')
            ->filters([
                TernaryFilter::make('status')
                    ->label('Status')
                    ->nullable()
                    ->placeholder('Semua')
                    ->trueLabel('Sudah Dibayar')
                    ->falseLabel('Belum Dibayar')
                    ->queries(
                        true: fn(Builder $query) => $query->where('status', 'Sudah Dibayar'),
                        false: fn(Builder $query) => $query->where('status', 'Belum Dibayar'),
                        blank: fn(Builder $query) => $query, // In this example, we do not want to filter the query when it is blank.
                    ),
            ])
            ->actions([
                Action::make('print')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->url(fn(Invoice $record): string => route('print.invoice', $record))
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}