<?php

namespace App\Filament\Premi\Resources;

use App\Filament\Premi\Resources\DataClientResource\Pages;
use App\Filament\Premi\Resources\DataClientResource\RelationManagers;
use App\Libraries\Benkkstudios;
use App\Models\DataClient;
use App\Models\DataClients;
use App\Models\Perusahaan;
use App\Models\SalesGroups;
use App\Models\User;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Carbon\Carbon;
use DateTime;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DataClientResource extends Resource
{
    protected static ?string $model = DataClients::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = "Data Transaksi";
    protected static ?string $navigationGroup = 'Transaksi';

    public static function canCreate(): bool
    {
        return Auth::user()->role == User::SALES;
    }
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
                TextInput::make('transportasi')->placeholder('MT. ES JEWEL ')->label('Nama Kapal'),
                TextInput::make('lokasi_muat')->label('PELABUHAN MUAT')->required()->placeholder('TABALONG'),
                TextInput::make('pib')->label('PEB/PIB')->numeric()->required()->placeholder('000045'),
                TextInput::make('pengirim')->label('Shipper')->required()->placeholder('PT. Segara Hutama Karya Exim'),
                TextInput::make('tonase')
                    ->suffix('MT')
                    ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2)
                    ->required(),

                DatePicker::make('tanggal')->Label('Tanggal Tanggal Pembuatan')->default(now())->required(),
                TextInput::make('nomor')->label("NO. Transaksi")->default(Benkkstudios::createInvoiceNumber())->columnSpanFull(),
                TextInput::make('group')
                    ->columnSpanFull()
                    ->readOnly()
                    ->default(fn() => SalesGroups::find(User::find(auth()->user()->id)->group)->name),
                Hidden::make('user')->default(auth()->user()->id)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor')->label('#NO')->limit(10)->searchable()->sortable(),
                BadgeableColumn::make('user')
                    ->label('SALES')
                    ->getStateUsing(
                        function ($record) {
                            $user = User::find($record->user);

                            return $user->name;
                        }
                    )
                    ->suffixBadges([
                        Badge::make('LEADER')
                            ->label('LEADER')
                            ->color('success')
                            ->visible(fn(DataClients $record) => User::find($record->user)->level == SalesGroups::LEADER),
                        Badge::make('ANGGOTA')
                            ->label('ANGGOTA')
                            ->color('warning')
                            ->visible(fn(DataClients $record) => User::find($record->user)->level == SalesGroups::ANGGOTA),
                    ]),
                Tables\Columns\TextColumn::make('pib')->label('PIB')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('tanggal')->searchable()->sortable()->getStateUsing(
                    function ($record) {
                        return Carbon::parse(DateTime::createFromFormat('Y-m-d', $record->tanggal))->translatedFormat('l, d M Y');
                    }
                ),

                Tables\Columns\TextColumn::make('transportasi')->label('Transport')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('lokasi_muat')->label('Lokasi')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('tonase')->searchable()->sortable()->getStateUsing(
                    function ($record): string {

                        return $record->tonase . ' MT';
                    }
                ),
                Tables\Columns\TextColumn::make('group')->searchable()->sortable(),

            ])->defaultSort('tanggal', 'desc')
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->user()->role === User::SALES) {
                    $group = SalesGroups::find(auth()->user()->group);
                    return $query->where('group', $group->name);
                }
            })
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(
                fn(DataClients $record): string => route('posts.edit', ['record' => $record]),
            );;
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
            'index' => Pages\ListDataClients::route('/'),
            'create' => Pages\CreateDataClient::route('/create'),
            'edit' => Pages\EditDataClient::route('/{record}/edit'),
        ];
    }
}
