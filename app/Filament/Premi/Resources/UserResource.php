<?php

namespace App\Filament\Premi\Resources;

use App\Filament\Premi\Resources\UserResource\Pages;
use App\Filament\Premi\Resources\UserResource\RelationManagers;
use App\Models\SalesGroups;
use App\Models\User;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
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
    protected static ?string $label = 'Data Sales';
    protected static ?string $navigationGroup = 'Sales';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('username')->required(),
                TextInput::make('email')->required(),
                Select::make('group')->options(SalesGroups::all()->pluck('name', 'id'))->required(),
                Select::make('level')->options(options: [SalesGroups::ANGGOTA => SalesGroups::ANGGOTA, SalesGroups::LEADER => SalesGroups::LEADER])->default(SalesGroups::ANGGOTA)->required(),
                TextInput::make('password')
                    ->required()
                    ->password()
                    ->revealable()
                    ->maxLength(255),
                Hidden::make('role')->default(User::SALES)
            ]);
    }
    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('role', User::SALES);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BadgeableColumn::make('name')
                    ->suffixBadges([
                        Badge::make('LEADER')
                            ->label('LEADER')
                            ->color('success')
                            ->visible(fn(User $record) => $record->level == SalesGroups::LEADER),
                        Badge::make('BELUM TERVERIFIKASI')
                            ->label('BELUM TERVERIFIKASI')
                            ->color('danger')
                            ->visible(fn(User $record) => is_null($record->owner_verified_at)),

                    ]),
                TextColumn::make('username'),
                TextColumn::make('email'),
                TextColumn::make('group')->getStateUsing(function (User $user) {
                    return SalesGroups::find($user->group)->name;
                })

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