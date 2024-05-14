<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequestsResource\Pages;
use App\Models\Requests;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RequestsResource extends Resource
{
    protected static ?string $model = Requests::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $title = 'Заявки';

    protected static ?string $breadcrumb = 'Заявки';

    protected static ?string $navigationLabel = 'Заявки';

    protected static ?string $pluralModelLabel = 'Заявки';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->columns(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label("Имя")
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('email')
                                    ->label("Почта")
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->email()
                                    ->required(),
                            ]),
                        Section::make()
                            ->schema([
                                MarkdownEditor::make('message')
                                    ->label("Сообщение")
                                    ->disableToolbarButtons([
                                        'attachFiles',
                                    ])
                                    ->required()
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label("Имя"),
                TextColumn::make('email')
                    ->label("Почта"),
                TextColumn::make('message')
                    ->label("Сообщение")
                    ->limit(50),
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
            'index' => Pages\ListRequests::route('/'),
            'create' => Pages\CreateRequests::route('/create'),
            'edit' => Pages\EditRequests::route('/{record}/edit'),
        ];
    }
}
