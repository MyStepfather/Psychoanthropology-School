<?php

namespace App\Constants;

final class ContentTypes
{
    public const COURS = 'course';
    public const BULLETIN = 'bulletin';
    public const ARTICLE = 'article';
    public const ENTRY_DOCUMENT = 'entry_document';
    public const ARTICLE_CONTACTS = 'article_contacts';


    public const ALL = [
        self::COURS,
        self::BULLETIN,
        self::ARTICLE,
        self::ENTRY_DOCUMENT,
        self::ARTICLE_CONTACTS,
        
    ];

    public const ALL_NAMES = [
        self::COURS => 'Курс',
        self::BULLETIN => 'Бюллетень связи',
        self::ARTICLE => 'Статья',
        self::ENTRY_DOCUMENT => 'Документ для участия в стажах',
        self::ARTICLE_CONTACTS => 'Статья для контактов',
    ];
}
