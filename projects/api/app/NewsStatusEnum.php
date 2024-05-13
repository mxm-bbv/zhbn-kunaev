<?php

namespace App;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum NewsStatusEnum: string implements HasColor, HasIcon, HasLabel
{
    case Draft = 'draft';

    case Published = 'published';

    case Archived = 'archived';

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::Draft => 'Черновик',
            self::Published => 'Опубликован',
            self::Archived => 'Архив',
        };
    }

    /**
     * @return string|array|null
     */
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Draft => 'info',
            self::Published => 'success',
            self::Archived => 'danger',
        };
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return match ($this) {
            self::Draft => 'heroicon-o-clipboard-document',
            self::Published => 'heroicon-o-arrow-up-on-square-stack',
            self::Archived => 'heroicon-o-archive-box',
        };
    }
}
