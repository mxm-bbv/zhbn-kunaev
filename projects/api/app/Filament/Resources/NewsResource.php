<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use App\NewsStatusEnum;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
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

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $title = 'Новости';

    protected static ?string $breadcrumb = 'Новости';

    protected static ?string $navigationLabel = 'Новости';

    protected static ?string $pluralModelLabel = 'Новости';

    public static function form(Form $form): Form
    {


//        collect(config('app.locales'))
//            ->map(function ($locale) {
//                return [
//                    Forms\Components\TextInput::make(sprintf('title.%s', $locale)),
//                    Forms\Components\TextInput::make(sprintf('description.%s', $locale))
//                ];
//            })
//            ->flatten()
//            ->toArray()

        return $form
            ->schema([
                Tabs::make('Main Tabs')
                    ->tabs([
                        Tabs\Tab::make('Переводы')
                            ->schema([
                                Tabs::make('Языки')
                                    ->tabs(
                                        collect(config('app.locales'))
                                            ->map(fn(string $locale) => Tabs\Tab::make(strtoupper($locale))
                                                ->label(strtoupper($locale))
                                                ->schema([
                                                    TextInput::make(sprintf('title.%s', $locale))->label('Заголовок'),
                                                    TextInput::make(sprintf('description.%s', $locale))->label('Описание')
                                                ]))
                                            ->toArray()
                                    ),
                            ]),
                    ]),
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
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
                    ->formatStateUsing(fn($state) => NewsStatusEnum::getStatusTranslation($state))
                    ->color(fn($state) => NewsStatusEnum::getStatusColor($state)),
                Tables\Columns\TextColumn::make('created_at')
                    ->label("Опубликовано")
                    ->since()
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label("Статус")
                    ->options(NewsStatusEnum::getStatuses())
            ])
            ->actions([
                EditAction::make()
                    ->tooltip('Изменить')
                    ->label(''),
                Tables\Actions\Action::make('archive')
                    ->tooltip("Архивировать")
                    ->label("")
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
                    )->hidden(fn(News $news) => NewsStatusEnum::getStatus($news->status) === NewsStatusEnum::ARCHIVED),
                Tables\Actions\Action::make('publish')
                    ->tooltip("Опубликовать")
                    ->label("")
                    ->icon('heroicon-o-arrow-up-on-square-stack')
                    ->color('success')
                    ->hidden(fn(News $news) => match (NewsStatusEnum::getStatus($news->status)) {
                        NewsStatusEnum::ARCHIVED, NewsStatusEnum::PUBLISHED => true,
                        NewsStatusEnum::DRAFT => false
                    })
                    ->action(function (News $state) {
                        if ($state->trashed()) {
                            $state->restore();
                        }

                        $state->update(['status' => NewsStatusEnum::PUBLISHED]);
                    }
                    ),
                Tables\Actions\Action::make('draft')
                    ->tooltip("В черновик")
                    ->label("")
                    ->color("info")
                    ->icon("heroicon-o-clipboard-document")
                    ->action(fn(News $news) => $news->update(['status' => NewsStatusEnum::DRAFT]))
                    ->hidden(fn(News $news) => match (NewsStatusEnum::getStatus($news->status)) {
                        NewsStatusEnum::DRAFT, NewsStatusEnum::ARCHIVED => true,
                        NewsStatusEnum::PUBLISHED => false,
                    }),
                ForceDeleteAction::make()
                    ->tooltip("Удалить")
                    ->label("")
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Новость удалена')
                            ->body('Новость была успешно удалена.'),
                    ),
                RestoreAction::make()
                    ->tooltip('Восстановить')
                    ->label('')
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
