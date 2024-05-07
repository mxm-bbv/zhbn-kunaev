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

    const COLOR = [
        self::DRAFT => 'info',
        self::ARCHIVED => 'danger',
        self::PUBLISHED => 'success'
    ];

    /**
     * @param int $status
     * @return int
     */
    public static function getStatus(int $status): int
    {
        return self::STATUS[$status];
    }

    /**
     * @return string[]
     */
    public static function getStatuses(): array
    {
        return self::STATUS;
    }

    /**
     * @param string $status
     * @return string
     */
    public static function getStatusColor(string $status): string
    {
        return self::COLOR[$status];
    }
}
