<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\Article;
use App\NewsStatusEnum;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticlesResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $title = 'Новости';

    protected static ?string $breadcrumb = 'Новости';

    protected static ?string $navigationLabel = 'Новости';

    protected static ?string $pluralModelLabel = 'Новости';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->columnSpanFull()
                    ->schema([
                        Section::make()
                            ->schema(static::getDetailsFormSchema()),
                        Section::make()
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('media')
                                    ->label('Медиа')
                                    ->collection('news-media')
                                    ->disk('public')
                                    ->directory('news-media')
                                    ->multiple()
                                    ->reorderable()
//                                    ->rules([
//                                        'files' => ['sometimes', 'array'],
//                                        'files.*' => ['mimes:jpg,jpeg,png,webp']
//                                    ])
                                    ->customHeaders(['Cache-Control' => 'no-cache']),
                            ])
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
                TextColumn::make('title')
                    ->label("Заголовок"),
                TextColumn::make('description')
                    ->label("Описание")
                    ->limit(50),
                TextColumn::make('status')
                    ->label("Статус")
                    ->color(fn($state) => NewsStatusEnum::getStaticColor($state))
                    ->icon(fn($state) => NewsStatusEnum::getStaticIcon($state))
                    ->formatStateUsing(fn($state) => NewsStatusEnum::getStaticLabel($state))
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label("Опубликовано")
                    ->since()
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label("Статус")
                    ->options(NewsStatusEnum::class)
            ])
            ->actions([
                EditAction::make()
                    ->tooltip('Изменить')
                    ->label(''),

                Action::make('archive')
                    ->tooltip("Архивировать")
                    ->label("")
                    ->icon(NewsStatusEnum::getStaticIcon('archived'))
                    ->color(NewsStatusEnum::getStaticColor('archived'))
                    ->action(fn(Article $news) => $news->delete())
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->icon(NewsStatusEnum::getStaticIcon('archived'))
                            ->color(NewsStatusEnum::getStaticColor('archived'))
                            ->title('Новость архивирована')
                            ->body('Новость была успешно архивирована.'),
                    )
                    ->hidden(fn(Article $news) => NewsStatusEnum::getStaticLabel($news->status) == NewsStatusEnum::Archived),

                Action::make('publish')
                    ->tooltip("Опубликовать")
                    ->label("")
                    ->icon(NewsStatusEnum::getStaticIcon('published'))
                    ->color(NewsStatusEnum::getStaticColor('published'))
                    ->hidden(fn(Article $news) => match (NewsStatusEnum::getStaticLabel($news->status)) {
                        NewsStatusEnum::Archived, NewsStatusEnum::Published => true,
                        default => false
                    })
                    ->action(function (Article $news) {
                        if ($news->trashed()) {
                            $news->restore();
                        }

                        $news->update(['status' => NewsStatusEnum::Published]);
                    }),

                Action::make('draft')
                    ->tooltip("В черновик")
                    ->label("")
                    ->color(NewsStatusEnum::getStaticColor('draft'))
                    ->icon(NewsStatusEnum::getStaticIcon('draft'))
                    ->action(fn(Article $news) => $news->update(['status' => NewsStatusEnum::Draft]))
                    ->hidden(fn(Article $news) => match (NewsStatusEnum::getStaticLabel($news->status)) {
                        NewsStatusEnum::Draft, NewsStatusEnum::Archived => true,
                        default => false,
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
                    ->action(fn(Article $state) => $state->restore())
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
                            fn(Article $news) => $news->delete()
                        )),
                    BulkAction::make('forceDelete')
                        ->requiresConfirmation()
                        ->action(fn(Collection $records) => $records->each(
                            fn(Article $news) => $news->forceDelete()
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getDetailsFormSchema(): array
    {
        return [
            ToggleButtons::make('status')
                ->inline()
                ->options(NewsStatusEnum::class)
                ->required(),

            Tabs::make('Языки')
                ->tabs(
                    collect(config('app.locales'))
                        ->map(fn(string $locale) => Tabs\Tab::make(strtoupper($locale))->icon('heroicon-o-language')
                            ->label(strtoupper($locale))
                            ->schema([
                                TextInput::make(sprintf('title.%s', $locale))
                                    ->label('Заголовок')
                                    ->when($locale == 'ru', fn(TextInput $field) => $field->required()),
                                MarkdownEditor::make(sprintf('description.%s', $locale))
                                    ->label('Описание')
                                    ->columnSpan('full')
                                    ->disableToolbarButtons([
                                        'attachFiles',
                                    ])
                                    ->when($locale == 'ru', fn(MarkdownEditor $field) => $field->required()),
                            ]))
                        ->toArray()
                ),
        ];
    }
}
