<?php

namespace App\Constants;

final class OrderStatus
{
    public const NEW = 'new';
    public const PREPARE = 'prepare';
    public const PAID = 'paid';
    public const ERROR = 'error';
    public const CANCEL = 'cancel';

    const ALL = [
        self::NEW,
        self::PREPARE,
        self::PAID,
        self::ERROR,
        self::CANCEL,
    ];

    const ALL_NAMES = [
        self::NEW => 'Создан',
        self::PREPARE => 'В оплате',
        self::PAID => 'Оплачен',
        self::ERROR => 'Ошибка',
        self::CANCEL => 'Отменен',
    ];
}
