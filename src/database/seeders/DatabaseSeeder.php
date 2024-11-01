<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Constants\ContentTypes;
use App\Constants\GroupTypes;
use App\Constants\MediaTypes;
use App\Constants\OrderStatus;
use App\Constants\ProductCategories;
use App\Constants\SubscribesTypes;
use App\Constants\TestTextCourse;
use App\Constants\ProductVideoCategories;
use App\Models\Artist;
use App\Models\BookManager;
use App\Models\Content;
use App\Models\Council;
use App\Models\Country;
use App\Models\Course;
use App\Models\DailyVideo;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Exercise;
use App\Models\FormToSchool;
use App\Models\Group;
use App\Models\GroupVideo;
use App\Models\Language;
use App\Models\Media;
use App\Models\MediaResource;
use App\Models\MediaText;
use App\Models\News;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\Stans;
use App\Models\Subscription;
use App\Models\Town;
use App\Models\User;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

//        Создаем страны, совет/структура, города
         $council = Council::query()->create([
             'name' => 'Россия (Центр и Юг)',
             'order' => 1,
         ]);

         $country = Country::query()->create([
             'name' => 'Россия',
             'council_id' => $council->id,
             'order' => 1,
         ]);

//        $council_child = Council::query()->create([
//            'parent_id' => $counsil->id,
//            'name' => 'Центр и Юг',
//            'order' => 1,
//        ]);

        $town = Town::query()->create([
            'country_id' => $country->id,
            'council_id' => $council->id,
            'name' => 'Москва',
        ]);
         Town::query()->create([
             'country_id' => $country->id,
             'council_id' => $council->id,
             'name' => 'Нижний Новгород',
         ]);

         $council2 = Council::query()->create([
             'name' => 'Россия (Северо-Запад)',
             'order' => 1,
         ]);

         Town::query()->create([
             'country_id' => $country->id,
             'council_id' => $council2->id,
             'name' => 'Санкт-Петербург',
         ]);

         $council = Council::query()->create([
             'name' => 'Беларусь',
             'order' => 2,
         ]);

         $country = Country::query()->create([
             'council_id' => $council->id,
             'name' => 'Беларусь',
             'order' => 2,
         ]);
         Town::query()->create([
             'country_id' => $country->id,
             'council_id' => $council->id,
             'name' => 'Минск',
         ]);

         $council = Council::query()->create([
             'name' => 'Страны Балтии',
             'order' => 3,
         ]);

         $country = Country::query()->create([
             'name' => 'Литва',
             'council_id' => $council->id,
             'order' => 3,
         ]);

         Town::query()->create([
             'country_id' => $country->id,
             'council_id' => $council->id,
             'name' => 'Вильнюс',
         ]);

         $country = Country::query()->create([
             'name' => 'Латвия',
             'council_id' => $council->id,
             'order' => 4,
         ]);

         Town::query()->create([
             'country_id' => $country->id,
             'council_id' => $council->id,
             'name' => 'Рига',
         ]);

        $group = Group::query()->create([
            'type' => GroupTypes::WORK,
            'coordinator_user_id' => 1,
            'town_id' => $town->id,
            'country_id' => $town->country_id,
            'weekday' => 3,
            'time' => '11:30',
            'place' => 'м. Таганская / Марксистская Воронцовская, 6, с.1. Центр «СемьЯ»',
        ]);

        Group::query()->create([
            'type' => GroupTypes::READ,
            'coordinator_user_id' => 1,
            'town_id' => $town->id,
            'country_id' => $town->country_id,
            'weekday' => 1,
            'time' => '11:30',
            'place' => 'м. Китай город, Покровка 27 Центр «Самадева»',
        ]);

        Group::factory(7)->create();

        $user = User::query()->create([
            'group_id' => $group->id,
            'login' => 'alena',
            //            'password' => Hash::make('111'),
            'password' => Hash::make('111'),
            'name_first' => 'Алена',
            'name_last' => 'Ершова',
            'name_middle' => 'Викторовна',
            'avatar' => 'image/avatars/IMG_5651 — копия.jpg',
            'email' => '79262812867@ya.ru',
            'phone' => '79262812867',
            'is_active' => true,
            'is_public' => false,
        ]);

        $stepfather = User::query()->create([
            'group_id' => $group->id,
            'login' => 'stepfather',
            'password' => Hash::make('222'),
            'name_first' => 'Илья',
            'name_last' => 'Голяшов',
            'name_middle' => 'Викторович',
            'avatar' => '/storage/image/avatars/MtInpIEDW5I.jpg',
            'email' => 'ilya.golyashov@yandex.ru',
            'phone' => '79017043556',
            'is_active' => true,
            'is_public' => true,
        ]);

        //Назначаю членом совета регион Центр Юг России
        // $user->councils()->attach(2);
        // $user->helpers()->attach(2);

        User::query()->create([
            'name_last' => 'admin',
            'password' => Hash::make('12345678'),
            'email' => 'admin@admin.com',
            'is_active' => true,
        ]);
        User::query()->create([
            'password' => Hash::make('12345678'),
            'email' => 'test@example.com',
        ]);

        User::factory(25)->create();

        //контент

        News::query()->create([
            'author_id' => User::inRandomOrder()->first()->id,
            'editor_id' => User::inRandomOrder()->first()->id,
            'title' => '1 Вечера углубления ПА с Эннеей',
            'description' => 'Вечер пения во время обучения ПА в июле 2022',
            'image_url' => 'image/news/image4.jpg',
            'published_at' => Carbon::now(),
            'is_show' => true,
        ]);
        News::query()->create([
            'author_id' => User::inRandomOrder()->first()->id,
            'editor_id' => User::inRandomOrder()->first()->id,
            'title' => '2 Миссия русской Души',
            'description' => 'Углубление лекций семинара мая 2016г',
            'image_url' => 'image/news/image5.jpg',
            'published_at' => Carbon::now(),
            'is_show' => true,
        ]);
        News::query()->create([
            'author_id' => User::inRandomOrder()->first()->id,
            'editor_id' => User::inRandomOrder()->first()->id,
            'title' => '3 Миссия русской Души',
            'description' => 'Углубление лекций семинара мая 2016г',
            'image_url' => 'image/news/image5.jpg',
            'published_at' => Carbon::now(),
            'is_show' => true,
        ]);

        Exercise::query()->create([
            'type' => 0,
            'month' => null,
            'title' => 'Ежеквартальная практика',
            'date' => null,
            'text' => new HtmlString('Когда я вижу в себе гнев, грусть, страх, беспокойство или требование,
            я выбираю (с мужеством) воплотить качество Духа или поведение бодхисаттв,
            и наблюдаю эффект этого на себя и, возможно, на вокруг себя.
             <br>
            <i>Предложение: Когда я вижу в себе гнев, грусть, страх, беспокойство или требование, я выбираю (с мужеством)
             воплотить качество Духа или поведение бодхисаттв, и наблюдаю эффект этого на себя и,
             возможно, на свое окружение.</i>
            '),
        ]);
        Exercise::query()->create([
            'type' => 0,
            'month' => null,
            'title' => 'Практика до апрельского стажа',
            'date' => null,
            'text' => new HtmlString('Основная работа по освобождению от первого черного узла заключается в том,
            чтобы переносить неприятные проявления других (которые являются лишь выражением животного
            инстинктивного движения), не проявляя и не подавляя, просто наблюдая и трансформируя
            свои реакции, тем самым воплощая качество Духа или поведение бодхисаттв, то есть
            принимая решение жить на более высоком уровне, в резонансе с духом, которым вы являетесь.
            Быть перед кем-то неприятным означает, что вы находитесь в самой лучшей ситуации в мире!
            <br>
            <i>Предложение: Когда я осознаю, что нахожусь в маленьком негативном я,
            я немедленно вызываю более подходящее маленькое я и наблюдаю эффект внутри и вокруг себя.</i>
            '),
        ]);
        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime('+1 day', strtotime($today)));
        $afterTomorrow = date('Y-m-d', strtotime('+1 day', strtotime($tomorrow)));
        Exercise::query()->create([
            'type' => 1,
            'date' => null,
            'text' => 'Сегодня мы можем следовать Намерению быть связанными с Селимом Айсселем и с Великим Духом
            Психоантропологии Ашара Хуманис (с тремя Столпами), чтобы получать их помощь и Силу.',
        ]);
        Exercise::query()->create([
            'type' => 1,
            'date' => null,
            'text' => 'Я осознаю что моя жизнь является моей самой драгоценной собственностью и я
             могу всегда приглашать Истину и Любовь во все действия,которые сегодня предпринимаю',
        ]);
        Exercise::query()->create([
            'type' => 1,
            'date' => null,
            'text' => 'Сегодня я наблюдаю в себе яд внутреннего учитывания ,
            решаю его остановить и выбираю внешнее учитывания и хорошее отношение к людям',
        ]);
        $eventType = EventType::query()->create([
            'name' => 'Стаж',
        ]);
        Event::query()->create([
            'event_type_id' => $eventType->id,
            'date_start' => Carbon::create(2023, 8, 25),
            'date_end' => Carbon::create(2023, 8, 28),
        ]);
        Event::query()->create([
            'event_type_id' => $eventType->id,
            'date_start' => Carbon::create(2023, 12, 15),
            'date_end' => Carbon::create(2023, 12, 17),
        ]);
        Event::query()->create([
            'event_type_id' => $eventType->id,
            'date_start' => Carbon::create(2024, 12, 15),
            'date_end' => Carbon::create(2024, 12, 17),
        ]);
        Event::query()->create([
            'event_type_id' => $eventType->id,
            'date_start' => Carbon::create(2023, 8, 25),
            'date_end' => Carbon::create(2023, 8, 28),
        ]);

        $eventType = EventType::query()->create([
            'name' => 'Дни обучений ПА',
        ]);
        Event::query()->create([
            'event_type_id' => $eventType->id,
            'date_start' => Carbon::create(2023, 7, 22),
            'date_end' => Carbon::create(2023, 7, 23),
        ]);
        Event::query()->create([
            'event_type_id' => $eventType->id,
            'date_start' => Carbon::create(2023, 10, 21),
            'date_end' => Carbon::create(2023, 10, 22),
        ]);
        Event::query()->create([
            'event_type_id' => $eventType->id,
            'date_start' => Carbon::create(2024, 7, 22),
            'date_end' => Carbon::create(2024, 7, 23),
        ]);
        Event::query()->create([
            'event_type_id' => $eventType->id,
            'date_start' => Carbon::create(2024, 10, 21),
            'date_end' => Carbon::create(2024, 10, 22),
        ]);

        $language = Language::query()->create([
            'name' => 'Русский',
        ]);
        Language::query()->create([
            'name' => 'Французский',
        ]);
        Language::query()->create([
            'name' => 'Транскрипция',
        ]);

        /**
         * создаем Стансы
         */
        for ($i = 0; $i < 15; $i++) {
            $media = Media::query()->create([
                'name' => "Возвращение к Бессмертию",
                'type' => MediaTypes::AUDIO,
                'is_free' => true,
            ]);
            Stans::query()->create([
                'media_id' => $media->id,
                'number' => $i,
            ]);
        }

        $media = Media::query()->create([
            'name' => 'Отвергать всяческое тщеславие',
            'type' => MediaTypes::AUDIO,
            'is_free' => true,
        ]);
        Stans::query()->create([
            'media_id' => $media->id,
            'number' => 47,
            'date_start' => Carbon::create(2023, 8, 3),
            'date_end' => Carbon::create(2024, 10, 9),
        ]);

        MediaText::query()->create([
            'language_id' => $language->id,
            'media_id' => $media->id,
            'title' => 'Отвергать всяческое тщеславие',
            'text' => new HtmlString(
                'О, дочь Земли, <br>
                        Хочу научить <br>
                        Отвергать тщеславие. <br>
                        Ибо вовлекает <br>
                        В недостойное оно, <br>
                        И Истину скрывает, <br>
                        Истину. <br>
                        Вечность — она без масок.'
            ),
        ]);
        MediaText::query()->create([
            'language_id' => 2, //Французский
            'media_id' => $media->id,
            'title' => 'Rejeter toute vanité',
            'text' => new HtmlString(
                '
                                O Fils de la Terre <br>
                                Je veux t’enseigner <br>
                                A rejeter toute vanité <br>
                                Car elle te précipite <br>
                                Vers ce que tu ne mérites pas <br>
                                Et te masque la Vérité <br>
                                L’Eternité n’a pas de masque'
            ),
        ]);
        MediaText::query()->create([
            'language_id' => 3, //Транскрипция
            'media_id' => $media->id,
            'title' => 'Rejeter toute vanité',
            'text' => new HtmlString(
                '
                                O Fils de la Terre <br>
                                Je veux t’enseigner <br>
                                A rejeter toute vanité <br>
                                Car elle te précipite <br>
                                Vers ce que tu ne mérites pas <br>
                                Et te masque la Vérité <br>
                                L’Eternité n’a pas de masque'
            ),
        ]);

        $artist = Artist::query()->create([
            'name' => 'Энея (фр.)',
        ]);
        MediaResource::query()->create([
            'media_id' => $media->id,
            'artist_id' => $artist->id,
            'language_id' => 2,
            'url' => 'storage/media/audio/stans/47ru.mp3',
        ]);

        $artist = Artist::query()->create([
            'name' => 'Катя Лахтина',
        ]);
        MediaResource::query()->create([
            'media_id' => $media->id,
            'artist_id' => $artist->id,
            'language_id' => $language->id,
            'url' => 'storage/media/audio/stans/47ru.mp3',
        ]);

        $artist = Artist::query()->create([
            'name' => '«Русский»',
        ]);
        MediaResource::query()->create([
            'media_id' => $media->id,
            'artist_id' => $artist->id,
            'language_id' => $language->id,
            'url' => 'storage/media/audio/stans/47ru.mp3',
        ]);

        $artist = Artist::query()->create([
            'name' => 'Pâlina',
        ]);
        MediaResource::query()->create([
            'media_id' => $media->id,
            'artist_id' => $artist->id,
            'language_id' => $language->id,
            'url' => 'storage/media/audio/stans/47ru.mp3',
        ]);

        $media = Media::query()->create([
            'name' => 'Три столпа',
            'type' => MediaTypes::AUDIO,
            'is_free' => true,
        ]);
        Media::query()->create([
            'name' => 'Никто из нас',
            'type' => MediaTypes::AUDIO,
            'is_free' => true,
        ]);
        Media::query()->create([
            'name' => 'Послушай, мой друг',
            'type' => MediaTypes::AUDIO,
            'is_free' => true,
        ]);
        Media::query()->create([
            'name' => 'Какая богатая душа моя',
            'type' => MediaTypes::AUDIO,
            'is_free' => true,
        ]);
        Media::query()->create([
            'name' => 'Я здесь вхожу',
            'type' => MediaTypes::AUDIO,
            'is_free' => true,
        ]);

        MediaText::query()->create([
            'language_id' => $language->id,
            'media_id' => $media->id,
            'title' => 'Три столпа',
            'text' => new HtmlString(
                'О, дочь Земли, <br>
                        Хочу научить <br>
                        Отвергать тщеславие. <br>
                        Ибо вовлекает <br>
                        В недостойное оно, <br>
                        И Истину скрывает, <br>
                        Истину. <br>
                        Вечность — она без масок.'
            ),
        ]);
        MediaText::query()->create([
            'language_id' => 2, //Французский
            'media_id' => $media->id,
            'title' => 'Rejeter toute vanité',
            'text' => new HtmlString(
                '
                                O Fils de la Terre <br>
                                Je veux t’enseigner <br>
                                A rejeter toute vanité <br>
                                Car elle te précipite <br>
                                Vers ce que tu ne mérites pas <br>
                                Et te masque la Vérité <br>
                                L’Eternité n’a pas de masque'
            ),
        ]);

        BookManager::query()->create([
            'user_id' => 1,
            'name' => 'Москва и Центральный регион',
        ]);

        BookManager::query()->create([
            'user_id' => 1,
            'name' => 'Санкт-Петербург',
        ]);

        //        for ($i = 1; $i < 60; $i++) {
        //            Content::query()->create([
        //                'type' => ContentTypes::COURS,
        //                'number' => $i,
        //                'name' => "$i Слушать свое дыхание",
        //                'text' => new HtmlString(TestTextCourse::TEXT_COURS),
        //            ]);
        //        }

        for ($i = 1; $i < 3; $i++) {
            Content::query()->create([
                'type' => ContentTypes::BULLETIN,
                'number' => 250 + $i,
                'date' => '2023.03.01',
                'url' => 'storage/content/bulletin/zdch280.pdf',
            ]);
        }

        for ($i = 1; $i < 3; $i++) {
            Content::query()->create([
                'type' => ContentTypes::BULLETIN,
                'number' => 250 + $i,
                'date' => '2022.08.01',
                'url' => 'storage/content/bulletin/zdch280.pdf',
                'text' => "Какой-то контент у данной биллютени $i",
            ]);
        }

        for ($i = 1; $i < 3; $i++) {
            Content::query()->create([
                'type' => ContentTypes::ARTICLE,
                'name' => "$i Текст прочитанный Эннеей",
                'text' => new HtmlString(TestTextCourse::TEXT_COURS),
            ]);
        }

        for ($i = 1; $i < 3; $i++) {
            Content::query()->create([
                'type' => ContentTypes::ENTRY_DOCUMENT,
                'name' => "$i Текст We Chat",
                'url' => 'storage/content/bulletin/zdch280.pdf',
            ]);
        }

        /**
         * Документ для скачивания в разделе Стати, тексты, другие доки
         */
        Content::query()->create([
            'type' => ContentTypes::ARTICLE,
            'name' => 'Духовная биография',
            'url' => 'storage/content/bulletin/zdch280.pdf',
        ]);

        $today = Carbon::now()->startOfWeek();

        for ($i = 0; $i < 60; $i++) {
            $dateStart = $today->copy()->addWeeks($i);
            $dateEnd = $dateStart->copy()->endOfWeek();

            $course = Course::query()
                ->create([
                    'number' => 700 + $i,
                    'name' => "$i Жадность бодхисаттвы",
                    'text' => new HtmlString(TestTextCourse::TEXT_COURS),
                    'date_start' => $dateStart,
                    'date_end' => $dateEnd,
                ]);

            $group = Group::query()->inRandomOrder()->first();
            $course->groups()->attach($group, ['date_start' => $dateStart, 'date_end' => $dateEnd]);
        }

        // for ($i = 0; $i < 20; $i++) {
        //     $user = User::inRandomOrder()->first();
        //     $councils = Council::inRandomOrder()->first();

        //     $user->councils()->attach($councils->id);
        // }

        //Создаем подписки для юзера id = 1
        $dateStart = new DateTime('first day of this month');
        $dateEnd = new DateTime('last day of this month');

        $product = Product::query()->create([
            'name' => 'Ежемесячный взнос',
            'category' => ProductCategories::SUBSCRIPTION,
            'code' => SubscribesTypes::MONTHLY,
            'price' => 450,
        ]);
        $order = Order::query()->create([
            'user_id' => 1,
            'status' => OrderStatus::PAID,
        ]);
        $order->products()->attach($product->id, [
            'amount' => 450,
            'quantity' => 1,
            'date_start' => $dateStart,
            'date_end' => $dateEnd,
        ]);

        Product::query()->create([
            'name' => 'Ежедневные видео',
            'description' => 'Запись видео',
            'category' => ProductCategories::SUBSCRIPTION,
            'code' => SubscribesTypes::VIDEO,
            'price' => 700,
        ]);

        $product = Product::query()->create([
            'name' => 'Ежедневные видео + ZOOM',
            'description' => 'Запись+ZOOM',
            'category' => ProductCategories::SUBSCRIPTION,
            'code' => SubscribesTypes::ZOOM,
            'price' => 940,
        ]);
        $order = Order::query()->create([
            'user_id' => 1,
            'status' => OrderStatus::PAID,
        ]);
        $order->products()->attach($product->id, [
            'amount' => 940,
            'quantity' => 1,
            'date_start' => $dateStart,
            'date_end' => $dateEnd,
        ]);
        $order->products()->attach($product->id, [
            'amount' => 940,
            'quantity' => 1,
            'date_start' => Carbon::create(2023, 2, 1),
            'date_end' => Carbon::create(2023, 2, 28),
        ]);
        $order->products()->attach($product->id, [
            'amount' => 940,
            'quantity' => 1,
            'date_start' => Carbon::create(2023, 3, 1),
            'date_end' => Carbon::create(2023, 3, 31),
        ]);
        $order->products()->attach($product->id, [
            'amount' => 940,
            'quantity' => 1,
            'date_start' => Carbon::create(2022, 2, 1),
            'date_end' => Carbon::create(2022, 2, 28),
        ]);



        for ($i = 0; $i < 60; $i++) {
            DailyVideo::query()->create([
                'date' => $dateStart->format('Y-m-d'),
                'name' => " $i Там, где начинается уровень истинного Ученика",
                'url' => '<iframe title="vimeo-player" src="https://player.vimeo.com/video/30292292?h=6b7b8794b1" frameborder="0" allowfullscreen></iframe>',
            ]);

            $dateStart = Carbon::instance($dateStart)->addDay();
        }

        DailyVideo::query()->create([
            'date' => Carbon::create(2023, 2, 1),
            'name' => ' Там, где начинается уровень истинного Ученика',
            'url' => '<iframe title="vimeo-player" src="https://player.vimeo.com/video/30292292?h=6b7b8794b1" frameborder="0" allowfullscreen></iframe>',
        ]);
        DailyVideo::query()->create([
            'date' => Carbon::create(2023, 3, 1),
            'name' => ' Там, где начинается уровень истинного Ученика',
            'url' => '<iframe title="vimeo-player" src="https://player.vimeo.com/video/30292292?h=6b7b8794b1" frameborder="0" allowfullscreen></iframe>',
        ]);
        DailyVideo::query()->create([
            'date' => Carbon::create(2022, 2, 1),
            'name' => ' Там, где начинается уровень истинного Ученика',
            'url' => '<iframe title="vimeo-player" src="https://player.vimeo.com/video/30292292?h=6b7b8794b1" frameborder="0" allowfullscreen></iframe>',
        ]);

        /**
         *  Личная страница -Мои видео (Стажи, обучения)
         */
        for ($i = 0; $i < 10; $i++) {
            $randomCategory = ProductVideoCategories::ALL[array_rand(ProductVideoCategories::ALL)];
            $randomYear = strval(rand(2020, 2024));
            $product = Product::query()->create([
                'name' => "$i Этика духовного пробуждения Мастеров Самары",
                'category' => $randomCategory,
                'year' => $randomYear,
                'description' => 'Онлайн-видео и аудио <br>Время: 97 минут',
                'price' => 1000,
                'cover' => 'storage/image/cover/colletions-2.png',
            ]);

            $media = Media::query()->create([
                'type' => MediaTypes::VIDEO,
            ]);

            $order = Order::query()->create([
                'user_id' => 1,
                'status' => OrderStatus::PAID,
            ]);

            $product->media()->attach($media->id);
            $order->products()->attach($product->id, [
                'amount' => 3000,
                'quantity' => 1,
            ]);
        }

        $artistSA = Artist::query()->create([
            'name' => 'Селим Айссель',
        ]);
        // Создаем книги
        for ($i = 0; $i < 10; $i++) {
            $product = Product::query()->create([
                'name' => "$i Ойа Самадева",
                'category' => ProductCategories::BOOK,
                'description' => 'Контакт с силой источника',
                'price' => 500,
                'cover' => 'storage/image/cover/colletions-1.png',
                'artist_id' => $artistSA->id
            ]);

            $media = Media::query()->create([
                'type' => MediaTypes::BOOK,
            ]);

            MediaResource::query()->create([
                'media_id' => $media->id,
                'artist_id' => $artistSA->id,
                'language_id' => 1,
                'url' => 'storage/content/bulletin/zdch280.pdf',
            ]);
        }


        $currentWeekStart = Carbon::now()->startOfWeek(); // Начало текущей недели
        $dateEnd = Carbon::now()->endOfWeek();

        GroupVideo::query()->create([
            'date' => Carbon::create(2011, 8, 16),
            'name' => 'Встреча с высшим духом',
            'duration' => 14,
            'code' => 'S06-23',
            'password' => 'VIDEOPA-23',
            'url' => 'https://vimeo.com/showcase/pa-videos-groupe-a-venir',
            'date_start' => $currentWeekStart,
//            'date_end' => $dateEnd,
        'date_end' => Carbon::create(2025, 10, 18)
        ]);

        $nextWeekStart = Carbon::now()->startOfWeek()->addWeek(); // Начало следующей недели
        $nextWeekEnd = $nextWeekStart->copy()->endOfWeek();
        GroupVideo::query()->create([
            'date' => Carbon::create(2011, 9, 16),
            'name' => '2 Встреча с высшим духом',
            'duration' => 18,
            'code' => 'S07-23',
            'password' => 'VIDEOPA-23',
            'url' => 'https://vimeo.com/showcase/pa-videos-groupe-a-venir',
            'date_start' => $nextWeekStart,
//            'date_end' => $nextWeekEnd,
            'date_end' => Carbon::create(2025, 10, 18)
        ]);

        Role::query()->create([
            'name' => 'admin',
            'display_name' => 'Администратор',
        ]);

        Role::query()->create([
            'name' => 'user',
            'display_name' => 'Пользователь',
        ]);

        User::Find(1)->roles()->attach(1);
        User::Find(1)->roles()->attach(2);
        $stepfather->roles()->attach(1);
        $stepfather->roles()->attach(2);

        $dataFormToSchool = [
            [
                'topic' => ['Вопрос по курсу', 'Запись на мастер-класс', 'Проблемы с доступом'],
                'articles' => [
                    'https://example.com/article1',
                    'https://example.com/article2',
                    'https://example.com/article3',
                ],
                'recipient' => ['Иванов', 'Петров', 'Сидоров'],
            ],
            [
                'topic' => ['Консультация по теории', 'Запрос материалов', 'Прочие вопросы'],
                'articles' => [
                    'https://example.com/article4',
                    'https://example.com/article5',
                    'https://example.com/article6',
                ],
                'recipient' => ['Коваленко', 'Смирнова', 'Беляев'],
            ],
        ];

        foreach ($dataFormToSchool as $item) {
            FormToSchool::create([
                'topic' => json_encode($item['topic']),
                'articles' => json_encode($item['articles']),
                'recipient' => json_encode($item['recipient']),
            ]);
        }
    }
}
