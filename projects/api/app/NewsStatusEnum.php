<?php

namespace App;

enum NewsStatusEnum
{
    public const DRAFT = 'draft';
    public const PUBLISHED = 'published';
    public const ARCHIVED = 'archived';

    const STATUS = [
        0 => self::DRAFT,
        1 => self::ARCHIVED,
        2 => self::PUBLISHED
    ];

    const TRANSLATION = [
        0 => 'Черновик',
        1 => 'Архив',
        2 => 'Опубликован'
    ];

    const COLOR = [
        self::DRAFT => 'info',
        self::ARCHIVED => 'danger',
        self::PUBLISHED => 'success'
    ];

    /**
     * @param int $status
     * @return string
     */
    public static function getStatus(int $status): string
    {
        return self::STATUS[$status];
    }

    public static function getStatusTranslation(string $status): string
    {
        return self::TRANSLATION[$status];
    }

    /**
     * @return string[]
     */
    public static function getStatuses(): array
    {
        return self::STATUS;
    }

    /**
     * @param int $status
     * @return string
     */
    public static function getStatusColor(int $status): string
    {
        return self::COLOR[self::STATUS[$status]];
    }
}
