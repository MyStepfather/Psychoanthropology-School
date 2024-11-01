<?php

namespace App\Constants;

final class ProductVideoCategories
{
    public const FORMATION = 'formation';
    public const STAGE = 'stage';
    public const COLLECTION = 'collection';
    const ALL = [
        self::FORMATION,
        self::STAGE,
        self::COLLECTION,
    ];
    const ALL_NAMES = [
        self::FORMATION => 'Обучения',
        self::STAGE => 'Стажи',
        self::COLLECTION => 'Сборники',
    ];
}
