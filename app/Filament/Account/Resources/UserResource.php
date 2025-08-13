<?php

namespace App\Filament\Account\Resources;

use App\Filament\Account\Resources\UserResource\Pages;
use App\Filament\Account\Resources\UserResource\RelationManagers;
use App\Models\User;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $label = 'Data Pengguna';
    protected static ?string $navigationGroup = 'Pengaturan';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('username')->required(),
                TextInput::make('email')->required(),
                TextInput::make('password')
                    ->required()
                    ->password()
                    ->revealable()
                    ->maxLength(255),
                Select::make('role')
                    ->default(User::USER)
                    ->options([
                        User::USER => User::USER,
                        User::MOD => User::MOD,
                        User::SUPER => User::SUPER,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BadgeableColumn::make('name')
                    ->suffixBadges([
                        Badge::make('TERVERIFIKASI')
                            ->label('TERVERIFIKASI')
                            ->color('success')
                            ->visible(fn(User $record) => !is_null($record->owner_verified_at)),
                        Badge::make('BELUM TERVERIFIKASI')
                            ->label('BELUM TERVERIFIKASI')
                            ->color('danger')
                            ->visible(fn(User $record) => is_null($record->owner_verified_at)),
                    ]),
                TextColumn::make('username'),
                TextColumn::make('email'),
                SelectColumn::make('role')
                    ->options([
                        User::SUPER => User::SUPER,
                        User::MOD => User::MOD,
                        User::USER => User::USER,
                    ])
                    ->rules(['required'])
                    ->selectablePlaceholder(false)

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Verifikasi')
                    ->icon('heroicon-o-check-circle')
                    ->visible(fn(User $user) => is_null($user->owner_verified_at))
                    ->action(function (User $user) {
                        $user->touch('owner_verified_at');

                        Notification::make()
                            ->success()
                            ->title("User {$user->name} berhasil diverifikasi")
                            ->send();
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
