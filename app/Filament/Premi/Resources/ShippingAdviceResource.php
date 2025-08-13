<?php

namespace App\Filament\Premi\Resources;

use App\Filament\Premi\Resources\ShippingAdviceResource\Pages;
use App\Filament\Premi\Resources\ShippingAdviceResource\RelationManagers;
use App\Models\Agen;
use App\Models\Exportir;
use App\Models\SalesGroups;
use App\Models\ShippingAdvice;
use App\Models\Surveyor;
use App\Models\User;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShippingAdviceResource extends Resource
{
    protected static ?string $model = ShippingAdvice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'Data Shipping';
    protected static ?string $navigationGroup = 'Shipping Advice';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('status')->options(
                    [
                        'SCHEDULE' => 'SCHEDULE',
                        'LOADING' => 'LOADING',
                        'COMPLETE' => 'COMPLETE',
                    ]
                )->required()->columnSpanFull()->default('SCHEDULE'),
                Select::make('exportir')->options(Exportir::all()->pluck('nama', 'nama'))->required(),
                TextInput::make('kapal')->label('Nama Kapal')->required(),
                TextInput::make('tanggal_shipping')->label('Tanggal Shipping Instruction')->required(),
                DatePicker::make('tanggal_ijin')->label('Tanggal Ijin Muat')->required(),
                TextInput::make('nomor_ijin_muat')->label('Nomor Ijin Muat')->required(),
                TextInput::make('tonase')->label('Tonase')->suffix('MT'),
                Select::make('surveyor')->options(Surveyor::all()->pluck('nama', 'nama')),
                Select::make('agen')->options(Agen::all()->pluck('nama', 'nama')),
                TextInput::make('pelabuhan_muat'),
                TextInput::make('pelabuhan_bongkar'),
                TextInput::make('pembeli')->label('Nama Pembeli'),
                TextInput::make('penerima')->label('Nama penerima'),
                DatePicker::make('tanggal_loading')->label('Tanggal Loading'),
                TextInput::make('asal_barang')->label('Asal Barang'),
                TextInput::make('tanggal_bill_of_lading')->label('Tanggal Bill Of Lading'),
                TextInput::make('tanggal_laporan_surveyor')->label('Tanggal Laporan Surveyor'),
                TextInput::make('kalori')->label('Kalori')->suffix('ARB'),
                TextInput::make('harga_per_ton')->label('HARGA/TON')->suffix('USD'),
                TextInput::make('no_tanggal_peb')->label('NO. / TANGGAL PEB'),
                TextInput::make('no_tanggal_coo')->label('NO. / TANGGAL COO'),

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
                BadgeColumn::make('status')
                    ->colors([
                        'primary',
                        'secondary' => 'COMPLETE',
                        'warning' => 'reviewing',
                        'success' => 'LOADING',
                        'danger' => 'SCHEDULE',
                    ]),
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
                            ->visible(fn(ShippingAdvice $record) => User::find($record->user)->level == SalesGroups::LEADER),
                        Badge::make('ANGGOTA')
                            ->label('ANGGOTA')
                            ->color('warning')
                            ->visible(fn(ShippingAdvice $record) => User::find($record->user)->level == SalesGroups::ANGGOTA),
                    ]),
                TextColumn::make('group')->searchable()->sortable(),
                TextColumn::make('exportir'),
                TextColumn::make('kapal')->label('NAMA KAPAL'),
                TextColumn::make('tanggal_shipping'),
                TextColumn::make('tanggal_ijin'),
                TextColumn::make('nomor_ijin_muat'),
                TextColumn::make('tonase'),
                TextColumn::make('surveyor'),
                TextColumn::make('agen'),
                TextColumn::make('pelabuhan_muat'),
                TextColumn::make('pelabuhan_bongkar'),
                TextColumn::make('pembeli'),
                TextColumn::make('penerima'),
                TextColumn::make('tanggal_loading'),
                TextColumn::make('asal_barang'),
                TextColumn::make('tanggal_bill_of_lading'),
                TextColumn::make('tanggal_laporan_surveyor'),
                TextColumn::make('kalori'),
                TextColumn::make('harga_per_ton'),
                TextColumn::make('no_tanggal_peb'),
                TextColumn::make('no_tanggal_coo'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListShippingAdvice::route('/'),
            'create' => Pages\CreateShippingAdvice::route('/create'),
            'edit' => Pages\EditShippingAdvice::route('/{record}/edit'),
        ];
    }
}
