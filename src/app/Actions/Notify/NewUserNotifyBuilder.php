<?php

namespace App\Actions\Notify;

use App\Mail\ResetPassword;
use App\Models\User;
use App\Notifications\GroupChangesNotification;
use App\Notifications\GroupSettingslNotification;
use App\Notifications\NewUserNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class NewUserNotifyBuilder
{
    public function handle ($user)
    {

        $getAdmins = new GetAdminToNotify();

        $admins = $getAdmins->handle();

        $coordinator = $user->group->coordinator;

        Notification::send($admins, new NewUserNotification($user));
        Notification::send($coordinator, new NewUserNotification($user));
    }

}
