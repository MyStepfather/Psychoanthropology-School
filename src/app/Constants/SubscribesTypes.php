<?php

namespace App\Constants;

final class SubscribesTypes
{
    public const MONTHLY = 'monthly';
    public const VIDEO = 'video';
    public const ZOOM = 'zoom';

    public const ALL = [
        self::MONTHLY,
        self::VIDEO,
        self::ZOOM,
    ];

    public const ALL_NAMES = [
        self::MONTHLY => 'Ежемесячный взнос',
        self::VIDEO => 'Ежедевные видео',
        self::ZOOM => 'Ежедевные видео +  Zoom',
    ];
}
