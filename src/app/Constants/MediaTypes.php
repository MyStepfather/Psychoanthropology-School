<?php

namespace App\Constants;

final class MediaTypes
{
    public const AUDIO = 'audio';
    public const VIDEO = 'video';
    public const BOOK = 'book';

    public const ALL = [
        self::AUDIO,
        self::VIDEO,
        self::BOOK,
    ];

    public const ALL_NAMES = [
        self::AUDIO => 'Аудио',
        self::VIDEO => ' Видео',
        self::BOOK => 'Книга',
    ];
}
