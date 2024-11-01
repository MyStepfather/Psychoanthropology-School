<?php

namespace App\Models;

use App\Constants\OrderStatus;
use App\Constants\ProductCategories;
use App\Constants\SubscribesTypes;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPasswordNotification;

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
 *
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
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable implements FilamentUser, HasName, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group_id',
        'login',
        'password',
        'name_first',
        'name_last',
        'name_middle',
        'full_name',
        'avatar',
        'email',
        'phone',
        'telegram',
        'social',
        'is_active',
        'entered_at',
        'birthdate',
    ];

//    /**
//     * The attributes that should be hidden for serialization.
//     *
//     * @var array<int, string>
//     */
    //    protected $hidden = [
    //        'password',
    //    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function bookManagers(): HasMany
    {
        return $this->hasMany(BookManager::class, 'user_id');
    }

    /**
     * Редактор курса
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)->withPivot('date_start', 'date_end')->withTimestamps();
    }

    /**
     *  Координатор?
     */
    public function coordinators(): HasMany
    {
        return $this->HasMany(Group::class, 'coordinator_user_id');
    }

    /**
     * Помощник координатора?
     */
    public function helpers(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_helper', 'user_id', 'group_id');
    }

    /**
     * Член совета?
     */
    public function councils(): BelongsToMany
    {
        return $this->belongsToMany(Council::class)->withTimestamps();
    }


    /**
     * Роли
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Заказы пользователя
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Атрибут 'name' Фамилия Имя
     */
    public function getFullNameAttribute(): string
    {
        return $this->name_first . ' ' . $this->name_last;
    }

    /**
     * Получаем кол-во неоплаченных месяцев за последние 7 месяцев
     *
     * @return int
     */
    public function getUnpaidMonthsCountAttribute()
    {
        $threeMonthsAgo = now()->subMonths(3);
        /**
         * TODO реализовать проверку до/после 5 число месяца
         */

        $subscriptions = $this->orders()
            ->whereStatus(OrderStatus::PAID)
            ->whereHas('products', function ($query) {
                $query->whereIn('category', [ProductCategories::SUBSCRIPTION])
                    ->whereIn('code', [SubscribesTypes::MONTHLY]);
            })
            ->with(['products' => function ($query) use ($threeMonthsAgo) {
                $query->whereIn('category', [ProductCategories::SUBSCRIPTION])
                    ->wherePivot('date_start', '<=', $threeMonthsAgo);
            }])
            ->get();

        $unpaidMonthsCount = 3 - $subscriptions->count();

        return $unpaidMonthsCount;
    }

    public function setIsSubscribeAttribute($value)
    {
        return $this->attributes['is_subscribe'] = $value;
    }

    /**
     *  Доступ в админ панель
     * @return bool
     */
    public function canAccessFilament(): bool
    {
        return $this->roles()->where('name', 'admin')->exists();
    }

    public function getFilamentName(): string
    {
        return "{$this->name_first} {$this->name_last}";
    }

    /**Отправка уведомления о сбросе пароля на русском
     * @param $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
