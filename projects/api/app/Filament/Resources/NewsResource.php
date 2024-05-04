<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $title = 'Новости';

    protected static ?string $breadcrumb = 'Новости';

    protected static ?string $navigationLabel = 'Новости';

    protected static ?string $pluralModelLabel = 'Новости';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Переводы')
                    ->tabs(
                        collect(config('app.locales'))
                            ->each(
                                fn($locale) => Forms\Components\Tabs::make(strtoupper($locale))
                                    ->schema([
                                        Forms\Components\TextInput::make(sprintf('title.%s', $locale)),
                                        Forms\Components\TextInput::make(sprintf('description.%s', $locale)),
                                    ])
                            )
                            ->toArray()
                    )
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        $status = [
            'draft' => ['Черновик', 'orange'],
            'published' => ['Опубликовано', 'success'],
            'archived' => ['Архив', 'danger'],
        ];

        return $table
            ->columns([
                ImageColumn::make('avatar')->label("Картинка"),
                TextColumn::make('title')
                    ->label("Заголовок"),
                TextColumn::make('description')
                    ->label("Описание"),
                TextColumn::make('status')
                    ->label("Статус")
                    ->badge()
                    ->formatStateUsing(fn($state) => $status[$state][0])
                    ->color(fn($state) => $status[$state][1]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label("Опубликовано")
                    ->since()
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label("Статус")
                    ->options([
                        'draft' => 'Черновик',
                        'published' => 'Опубликовано',
                        'archived' => 'Архив',
                    ])
            ])
            ->actions([
                EditAction::make(),
                Tables\Actions\Action::make('archive')
                    ->label("Архивировать")
                    ->icon('heroicon-o-archive-box')
                    ->color('gray')
                    ->action(fn(News $news) => $news->delete())
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->icon('heroicon-o-archive-box')
                            ->color('gray')
                            ->title('Новость архивирована')
                            ->body('Новость была успешно архивирована.'),
                    )->hidden(fn(News $state) => $state->status === 'archived'),
                Tables\Actions\Action::make('publish')
                    ->label("Опубликовать")
                    ->icon('heroicon-o-arrow-up-on-square-stack')
                    ->color('success')
                    ->hidden(fn(News $news) => match ($news->status) {
                        'archived' => true,
                        'published' => true,
                        'draft' => false
                    })
                    ->action(fn(News $state) => $state->trashed() ?
                        function () use (&$state) {
                            $state->restore();
                            $state->update(['status' => 'published']);
                        } : $state->update(['status' => 'published'])
                    ),
                ForceDeleteAction::make()
                    ->label("Удалить")
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Новость удалена')
                            ->body('Новость была успешно удалена.'),
                    ),
                RestoreAction::make()
                    ->action(fn(News $state) => $state->restore())
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Новость восстановлена')
                            ->body('Новость была успешно восстановлена.'),
                    )
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('delete')
                        ->requiresConfirmation()
                        ->action(fn(Collection $records) => $records->each(
                            fn(News $news) => $news->delete()
                        )),
                    BulkAction::make('forceDelete')
                        ->requiresConfirmation()
                        ->action(fn(Collection $records) => $records->each(
                            fn(News $news) => $news->forceDelete()
                        )),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
