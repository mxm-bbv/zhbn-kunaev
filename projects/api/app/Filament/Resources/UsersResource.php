<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsersResource\Pages;
use App\Filament\Resources\UsersResource\RelationManagers;
use App\Models\User;
use App\Models\Users;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $title = 'Пользователи';

    protected static ?string $breadcrumb = 'Пользователи';

    protected static ?string $navigationLabel = 'Пользователи';

    protected static ?string $pluralModelLabel = 'Пользователи';

    protected static ?string $slug = 'users';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label("Имя"),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label("Почта"),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->label("Пароль")
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label("Имя"),
                Tables\Columns\TextColumn::make('email')->label("Почта"),
                Tables\Columns\TextColumn::make('roles')
                    ->label("Роль")
                    ->formatStateUsing(fn (User $user) => $user->getRoleNames()->first()),
                Tables\Columns\TextColumn::make('created_at')
                    ->label("Зарегистрирован")
                    ->since()
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUsers::route('/create'),
            'edit' => Pages\EditUsers::route('/{record}/edit'),
        ];
    }
}
