<?php

use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CoursePageController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\PersonalPageController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShopPageController;
use App\Http\Controllers\SchoolFormController;

use App\Http\Controllers\TeachingController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/** Route::get('/', function () {
return view('welcome');
});  */
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login-process', [AuthController::class, 'loginProcess'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => '/reset-password'], function () {
    Route::get('/show', [AuthController::class, 'showResetPassword'])->name('show.reset.password');
    Route::post('/process', [AuthController::class, 'processResetPassword'])->name('process.reset.password');
    Route::get('/success', [AuthController::class, 'successResetPassword'])->name('success.reset.password');
    Route::get('/{token}', function (string $token) {
        return view('auth.newPassword', ['token' => $token]);
    })->name('password.reset');

    Route::post('/process-password-update', [AuthController::class, 'processUpdatePassword'])
        ->name('process.password.update');
});

Route::group(['prefix' => '/register'], function () {
    Route::get('/step-1', [AuthController::class, 'showStep1'])->name('show.step1');
    Route::post('/process-1', [AuthController::class, 'processStep1'])->name('process.step1');
    Route::get('/step-2', [AuthController::class, 'showStep2'])->name('show.step2');
    Route::post('/process-2', [AuthController::class, 'processStep2'])->name('process.step2');
    Route::get('/step-3', [AuthController::class, 'showStep3'])->name('show.step3');
    Route::post('/process-3', [AuthController::class, 'processStep3'])->name('process.step3');
    Route::get('/step-4', [AuthController::class, 'showStep4'])->name('show.step4');
    Route::post('/process-4', [AuthController::class, 'processStep4'])->name('process.step4');
    Route::get('/success', [AuthController::class, 'success'])->name('success');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [MainPageController::class, 'showPage'])->name('main.show');

    Route::group(['prefix' => '/personal'], function () {
        Route::get('/', [PersonalPageController::class, 'showPersonalPage'])->name('personal.show');
        Route::group(['prefix' => '/my-video'], function () {
            Route::get('/', [PersonalPageController::class, 'showMyVideoPage'])
                ->name('personal.my-video.show');
            Route::get('/daily', [PersonalPageController::class, 'showDailyVideoPage'])
                ->name('personal.daily-video.show');
            Route::get('/formation', [PersonalPageController::class, 'showFormationVideoPage'])
                ->name('personal.formation-video.show');
            Route::get('/stage', [PersonalPageController::class, 'showStageVideoPage'])
                ->name('personal.stage-video.show');
            Route::get('/collection', [PersonalPageController::class, 'showCollectionVideoPage'])
                ->name('personal.collection-video.show');
        });
    });

    Route::get('/course/{id}', [CoursePageController::class, 'course'])->name('course.show');

    Route::get('/calendar', [CalendarController::class, 'showPage'])->name('calendar.show');

    Route::group(['prefix' => '/about'], function () {
        Route::get('/', [AboutPageController::class, 'showAboutPage'])
            ->name('about.show');
        Route::get('/council', [AboutPageController::class, 'showCouncilPage'])
            ->name('about.council.show');
        Route::get('/contacts', [AboutPageController::class, 'showContactsPage'])
            ->name('about.contacts.show');
    });

    Route::group(['prefix' => '/shop'], function () {
        Route::get('/daily-video', [ShopPageController::class, 'showDailyVideoPage'])
            ->name('shop.dailyVideo.show');
        Route::get('/teaching', [ShopPageController::class, 'showTeachingPage'])
            ->name('shop.teaching.show');
        Route::get('/collections', [ShopPageController::class, 'showCollectionsPage'])
            ->name('shop.collections.show');
        Route::get('/books', [ShopPageController::class, 'showBooksPage'])
            ->name('shop.books.show');
        Route::get('/archive', [ShopPageController::class, 'showArchivePage'])
            ->name('shop.archive.show');
        Route::get('/{id}', [ShopPageController::class, 'showProductItem'])->name('shop.product.show');
    });

    Route::post('/deleteAvatar', [SettingsController::class, 'deleteAvatar'])->name('deleteAvatar');
    Route::post('/updatePersonalData', [SettingsController::class, 'updatePersonalData'])->name('profile.update');
    Route::post('/changePassword', [SettingsController::class, 'changePassword'])->name('changePassword');
    Route::post('/changeEmail', [SettingsController::class, 'changeEmail'])->name('changeEmail');
    Route::post('/changeMembership', [SettingsController::class, 'changeMembership'])->name('changeMembership');
    Route::post('/changeContacts', [SettingsController::class, 'changeContacts'])->name('changeContacts');


    Route::group(['prefix' => '/settings'], function () {
        Route::get('/main', [SettingsController::class, 'showPage'])->name('settings.main.show');
        Route::get('/login', [SettingsController::class, 'showPage'])->name('settings.login.show');
        Route::get('/membership', [SettingsController::class, 'showPage'])->name('settings.membership.show');
        Route::get('/contacts', [SettingsController::class, 'showPage'])->name('settings.contacts.show');
    });

    Route::group(['prefix' => '/groups'], function () {
        Route::get('/five-way', [GroupsController::class, 'showFiveWay'])->name('groups.five-way');
        Route::get('/reading', [GroupsController::class, 'showReading'])->name('groups.reading');
        Route::get('/beginners', [GroupsController::class, 'showBeginners'])->name('groups.beginners');
        Route::get('/calendar', [GroupsController::class, 'showCalendar'])->name('groups.calendar');
    });
});



Route::middleware('auth')->group(function () {
    Route::group(['prefix' => '/teaching'], function () {
        Route::get('/tasks', [TeachingController::class, 'tasks'])->name('teaching.tasks');
        Route::get('/tasks/{id}', [TeachingController::class, 'showTaskItem'])->name('teaching.tasks.item');
        Route::get('/books', [TeachingController::class, 'books'])->name('teaching.books');
        Route::get('/songs', [TeachingController::class, 'songs'])->name('teaching.songs');
        Route::get('/songs/{id}', [TeachingController::class, 'showSongItem'])->name('teaching.song.item');
        Route::get('/bulletin', [TeachingController::class, 'bulletin'])->name('teaching.bulletin');
        Route::get('/bulletin/{id}', [TeachingController::class, 'showBulletinItem'])->name('teaching.bulletin.item');
        Route::get('/study', [TeachingController::class, 'study'])->name('teaching.study');
        Route::get('/archive', [TeachingController::class, 'archive'])->name('teaching.archive');
        Route::get('/others', [TeachingController::class, 'others'])->name('teaching.others');
        Route::get('/others/{id}', [TeachingController::class, 'showOthersItem'])->name('teaching.others.item');
    });
});