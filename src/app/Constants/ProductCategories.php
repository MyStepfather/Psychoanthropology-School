<?php

namespace App\Constants;

final class ProductCategories
{
    public const SUBSCRIPTION = 'subscription';
    public const BOOK = 'book';
    public const FORMATION = 'formation';
    public const STAGE = 'stage';
    public const COLLECTION = 'collection';

    const ALL = [
        self::SUBSCRIPTION,
        self::BOOK,
        self::FORMATION,
        self::STAGE,
        self::COLLECTION,
    ];
    const ALL_NAMES = [
        self::SUBSCRIPTION => 'Подписки',
        self::BOOK => 'Книги',
        self::FORMATION => 'Обучения',
        self::STAGE => 'Стажи',
        self::COLLECTION => 'Сборники',
    ];
}
