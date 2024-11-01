<?php

namespace App\Constants;

final class GroupTypes
{
    public const NEW = 'new';
    public const READ = 'read';
    public const WORK = 'work';

    public const ALL = [
        self::NEW,
        self::READ,
        self::WORK,
    ];

    public const ALL_NAMES = [
        self::NEW => 'Новичков/открытия',
        self::READ => 'Чтения',
        self::WORK => '5 Пути',
    ];

    public const ALL_DAYS = [
        1 => 'Понедельник',
        2 => 'Вторник',
        3 => 'Среда',
        4 => 'Четверг',
        5 => 'Пятница',
        6 => 'Суббота',
        7 => 'Воскресенье'
    ];
}
