<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Artist
 *
 * @property int $id
 * @property string|null $name Имя исполнителя
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MediaResource> $mediaResources
 * @property-read int|null $media_resources_count
 * @method static \Illuminate\Database\Eloquent\Builder|Artist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Artist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Artist query()
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Artist whereUpdatedAt($value)
 */
	class Artist extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BookManager
 *
 * @property int $id
 * @property int $user_id Id user, ответсвенного за заказ книг
 * @property string|null $name Название региона/города
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|BookManager newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookManager newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookManager query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookManager whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookManager whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookManager whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookManager whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookManager whereUserId($value)
 */
	class BookManager extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Content
 *
 * @property int $id
 * @property string $type Вид контента из const
 * @property int|null $number Номер документа
 * @property string|null $date Дата
 * @property string|null $name Название
 * @property string|null $description Описание
 * @property string|null $url Ссылка на документ
 * @property string|null $text Текст/html
 * @property int $is_publish Опубликована?
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Content newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content query()
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereIsPublish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereUrl($value)
 */
	class Content extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Council
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Council newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Council newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Council query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name Название
 * @property int $order Порядок сортировки
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Country> $countries
 * @property-read int|null $countries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Town> $towns
 * @property-read int|null $towns_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Council whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Council whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Council whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Council whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Council whereUpdatedAt($value)
 */
	class Council extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Country
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $council_id Id совета/структуры
 * @property string $name Название страны
 * @property int $order Порядок сортировки
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Council|null $council
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Group> $groups
 * @property-read int|null $groups_count
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCouncilId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Course
 *
 * @property int $id
 * @property int $number Номер курса
 * @property string $name Название курса
 * @property string $text Содержание курса
 * @property string|null $date_start Дата начала недели действия курса
 * @property string|null $date_end Дата окончания недели действия курса
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Group> $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereUpdatedAt($value)
 */
	class Course extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DailyVideo
 *
 * @property int $id
 * @property string $date Дата видео
 * @property string $name Название видео
 * @property string $url Ссылка на видео
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DailyVideo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DailyVideo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DailyVideo query()
 * @method static \Illuminate\Database\Eloquent\Builder|DailyVideo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyVideo whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyVideo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyVideo whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyVideo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyVideo whereUrl($value)
 */
	class DailyVideo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @property int $id
 * @property int $event_type_id ID типа события( например Дни ПА, Стаж
 * @property string|null $title Заголовок
 * @property string|null $text Текст
 * @property string $date_start Дата начала
 * @property string $date_end Дата окончания
 * @property int|null $is_show Показывать на главной странице?
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\EventType|null $eventType
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EventType
 *
 * @property int $id
 * @property string $name Тип события, Дни ПА, Стаж
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Event> $events
 * @property-read int|null $events_count
 * @method static \Illuminate\Database\Eloquent\Builder|EventType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventType query()
 * @method static \Illuminate\Database\Eloquent\Builder|EventType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventType whereUpdatedAt($value)
 */
	class EventType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Exercise
 *
 * @property int $id
 * @property int $type 0-актуальные, 1-ежедневные
 * @property string|null $title Название
 * @property string|null $month Месяц, в котором дано упражнение
 * @property string|null $date Дата упражнения
 * @property string $text Текст
 * @property string|null $published_at Дата публикации, если null, то не опубликована
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise query()
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercise whereUpdatedAt($value)
 */
	class Exercise extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FormToSchool
 *
 * @property int $id
 * @property mixed $topic Тема  JSON
 * @property mixed $articles url статьи  JSON
 * @property mixed $recipient кому  JSON
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FormToSchool newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormToSchool newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormToSchool query()
 * @method static \Illuminate\Database\Eloquent\Builder|FormToSchool whereArticles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormToSchool whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormToSchool whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormToSchool whereRecipient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormToSchool whereTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormToSchool whereUpdatedAt($value)
 */
	class FormToSchool extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Group
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $type Тип группы work, read, new
 * @property int|null $coordinator_user_id ID user - координатор
 * @property int|null $country_id ID страны
 * @property int|null $town_id Город (NULL для дистанционных групп)
 * @property int|null $weekday День проведения группы
 * @property string|null $time Время проведени группы
 * @property string|null $place Место проведения группы
 * @property int $is_online Дистанционная?
 * @property int $is_active Активна?
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $coordinator
 * @property-read \App\Models\Country|null $country
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Course> $courses
 * @property-read int|null $courses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $helpers
 * @property-read int|null $helpers_count
 * @property-read \App\Models\Town|null $town
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\GroupFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereCoordinatorUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereIsOnline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereTownId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereWeekday($value)
 */
	class Group extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GroupVideo
 *
 * @property int $id
 * @property string|null $date Дата видео
 * @property string|null $name Название видео
 * @property int|null $duration Продолжительность в минутах
 * @property string|null $code Код видео
 * @property string|null $password Пароль видео
 * @property string|null $url Ссылка
 * @property string|null $date_start Дата начала действия
 * @property string|null $date_end Дата окончания недели
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|GroupVideo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupVideo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupVideo query()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupVideo whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupVideo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupVideo whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupVideo whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupVideo whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupVideo whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupVideo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupVideo whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupVideo wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupVideo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupVideo whereUrl($value)
 */
	class GroupVideo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Language
 *
 * @property int $id
 * @property string $name Название языка
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MediaResource> $stansMedias
 * @property-read int|null $stans_medias_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MediaText> $stansTexts
 * @property-read int|null $stans_texts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereUpdatedAt($value)
 */
	class Language extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Media
 *
 * @property int $id
 * @property string|null $type Тип: аудио, видео, книги из const
 * @property string|null $name Название
 * @property int|null $is_free Бесплатное?
 * @property string|null $description Описание
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MediaResource> $mediaResources
 * @property-read int|null $media_resources_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MediaText> $mediaTexts
 * @property-read int|null $media_texts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Stans|null $stans
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereIsFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 */
	class Media extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MediaResource
 *
 * @property int $id
 * @property int $media_id ID станса
 * @property int|null $language_id ID языка
 * @property int|null $artist_id ID исполнителя
 * @property string $url Путь к файлу
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Artist|null $artist
 * @property-read \App\Models\Language|null $language
 * @property-read \App\Models\Media|null $media
 * @method static \Illuminate\Database\Eloquent\Builder|MediaResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaResource query()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaResource whereArtistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaResource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaResource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaResource whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaResource whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaResource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaResource whereUrl($value)
 */
	class MediaResource extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MediaText
 *
 * @property int $id
 * @property int $media_id ID станса
 * @property int $language_id ID языка
 * @property string|null $title Название станса
 * @property string|null $text Текст станса
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Language|null $language
 * @property-read \App\Models\Media|null $media
 * @method static \Illuminate\Database\Eloquent\Builder|MediaText newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaText newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaText query()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaText whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaText whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaText whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaText whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaText whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaText whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaText whereUpdatedAt($value)
 */
	class MediaText extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\News
 *
 * @property int $id
 * @property int|null $author_id Автор статьи user_id
 * @property int|null $editor_id Кто последний изменил user_id
 * @property string $title Заголовок статьи
 * @property string|null $description Анонс
 * @property string|null $text Текст
 * @property string|null $image_url Картинка к новости
 * @property string|null $video_url Видео к новости
 * @property string|null $published_at Дата публикации, если null, то не опубликована
 * @property int|null $is_show Показывать на главной странице?
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereEditorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereVideoUrl($value)
 */
	class News extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id Id пользователя
 * @property string $status Статус из CONST
 * @property string|null $email Почта для отправки заказа
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order paid()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name Название
 * @property string|null $category Категория из const
 * @property string|null $code Код из const
 * @property string|null $description Описание
 * @property string $price Цена
 * @property string|null $cover Обложка
 * @property int|null $artist_id ID автора
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereArtistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name Название - код
 * @property string|null $display_name Название на русском
 * @property string|null $comment Комментарий
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Stans
 *
 * @property int $id
 * @property int $media_id Связь с таблицой Media
 * @property int|null $number Номер станса от 0
 * @property string|null $date_start Дата начала недели действия станста
 * @property string|null $date_end Дата окончания недели действия станста
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Media|null $media
 * @method static \Illuminate\Database\Eloquent\Builder|Stans newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stans newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stans query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stans whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stans whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stans whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stans whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stans whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stans whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stans whereUpdatedAt($value)
 */
	class Stans extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Town
 *
 * @property int $id
 * @property int $country_id ID страны
 * @property int|null $council_id Id совета/структуры
 * @property string|null $name Название города
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Council|null $council
 * @property-read \App\Models\Country|null $country
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Group> $groups
 * @property-read int|null $groups_count
 * @method static \Illuminate\Database\Eloquent\Builder|Town newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Town newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Town query()
 * @method static \Illuminate\Database\Eloquent\Builder|Town whereCouncilId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Town whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Town whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Town whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Town whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Town whereUpdatedAt($value)
 */
	class Town extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $group_id ID группы
 * @property string|null $login Логин
 * @property string|null $name_first Имя
 * @property string|null $name_last фамилия
 * @property string|null $name_middle Отчество
 * @property string $full_name
 * @property string|null $avatar Аватар(ссылка на картинку)
 * @property string|null $phone
 * @property string|null $telegram Аккаунт в Телеграм
 * @property mixed|null $social Аккаунты в соцсетях
 * @property int|null $is_active Активный пользователь?
 * @property int|null $is_public Данные видны другим пользователям
 * @property string|null $entered_at Дата поступления в школу
 * @property string|null $birthdate Дата рождения
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BookManager> $bookManagers
 * @property-read int|null $book_managers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Group> $coordinators
 * @property-read int|null $coordinators_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Council> $councils
 * @property-read int|null $councils_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Course> $courses
 * @property-read int|null $courses_count
 * @property-read int $unpaid_months_count
 * @property-read \App\Models\Group|null $group
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Group> $helpers
 * @property-read int|null $helpers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-write mixed $is_subscribe
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEnteredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNameFirst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNameLast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNameMiddle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTelegram($value)
 */
	class User extends \Eloquent implements \Filament\Models\Contracts\FilamentUser {}
}

