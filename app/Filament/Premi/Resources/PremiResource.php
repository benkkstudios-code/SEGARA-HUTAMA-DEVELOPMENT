<?php

namespace App\Filament\Premi\Resources;

use App\Filament\Premi\Resources\PremiResource\Pages;
use App\Filament\Premi\Resources\PremiResource\RelationManagers;
use App\Libraries\Benkkstudios;
use App\Models\DataClients;
use App\Models\Premi;
use App\Models\Premis;
use App\Models\SalesGroups;
use App\Models\User;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Carbon\Carbon;
use DateTime;
use Filament\Actions\Modal\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action as ActionsAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class PremiResource extends Resource
{
    protected static ?string $model = Premis::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'Lihat Premi';
    protected static ?string $navigationGroup = 'Transaksi';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }
    public static function canCreate(): bool
    {
        return false;
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor')->searchable()->copyable()->copyMessage('Nomor berhasil disalin.'),
                TextColumn::make('type'),
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
                            ->visible(fn(Premis $record) => User::find($record->user)->level == SalesGroups::LEADER),
                        Badge::make('ANGGOTA')
                            ->label('ANGGOTA')
                            ->color('warning')
                            ->visible(fn(Premis $record) => User::find($record->user)->level == SalesGroups::ANGGOTA),
                    ]),
                BadgeableColumn::make('group')
                    ->label('GRUP')
                    ->getStateUsing(
                        function ($record) {
                            $group = SalesGroups::find($record->group);

                            return $group->name;
                        }
                    ),
                Tables\Columns\TextColumn::make('tanggal')->searchable()->sortable()->getStateUsing(
                    function ($record) {
                        return Carbon::parse(DateTime::createFromFormat('Y-m-d', $record->tanggal))->translatedFormat('l, d M Y');
                    }
                ),
                Tables\Columns\TextColumn::make('premi')->searchable()->sortable()->getStateUsing(
                    function ($record) {
                        return Benkkstudios::toRupiah($record->premi);
                    }
                ),
                Tables\Columns\BadgeColumn::make('status')
                    ->action(function ($state, $record) {
                        if (Auth::user()->hasAccess()) {
                            if ($record->status == 'Belum Dibayar') {
                                $record->status = 'Sudah Dibayar';
                            } else {
                                $record->status = 'Belum Dibayar';
                            }
                            $record->save();
                        } else {
                        }

                        // return Redirect::to($invoice);
                    })

                    ->colors([
                        'primary',

                        'success' => 'Sudah Dibayar',
                        'danger' => 'Belum Dibayar',
                    ])
            ])->modifyQueryUsing(function (Builder $query) {
                if (auth()->user()->role === User::SALES) {
                    if (auth()->user()->level === SalesGroups::LEADER) {
                        $group = SalesGroups::find(auth()->user()->group);
                        return $query->where('group', $group->id);
                    } else {
                        return $query->where('user', auth()->user()->id);
                    }
                }
            })

            ->filters([
                SelectFilter::make('group')
                    ->options(SalesGroups::pluck('name', 'id')),
                // Filter::make('tanggal')
                //     ->form([
                //         DatePicker::make('created_from')->label('Dari Tanggal')->default(Carbon::now()),
                //         DatePicker::make('created_until')->label(label: 'Sampai Tanggal')->default(Carbon::now())->maxDate(Carbon::now()),
                //     ])
                //     ->query(function (Builder $query, array $data): Builder {
                //         return $query
                //             ->when(
                //                 $data['created_from'],
                //                 fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                //             )
                //             ->when(
                //                 $data['created_until'],
                //                 fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                //             );
                //     })
            ])
            ->actions([
                ActionsAction::make('RubahPremi')
                    ->visible(Auth::user()->hasAccess())
                    ->requiresConfirmation()
                    ->fillForm(fn(Premis $record): array => [
                        'premi' => $record->premi,
                    ])
                    ->form([
                        TextInput::make('premi')
                            ->numeric()
                            ->required(),
                    ])
                    ->action(function (array $data, Premis $record): void {
                        $record->premi = $data['premi'];

                        $record->save();
                    })
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkAction::make('bayar')->label('BAYAR YANG DIPILIH')
                    ->visible(Auth::user()->hasAccess())
                    ->requiresConfirmation()

                    ->action(function (Collection  $records) {
                        foreach ($records as $record) {
                            $record->status = 'Sudah Dibayar';
                            $record->save();
                        }
                    })
            ])->defaultSort('id', 'desc');
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
            'index' => Pages\ListPremis::route('/'),
            'create' => Pages\CreatePremi::route('/create'),
            'edit' => Pages\EditPremi::route('/{record}/edit'),
        ];
    }
}
