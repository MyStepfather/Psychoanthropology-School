<?php

namespace App\Actions\Notify;

use App\Models\User;
use App\Notifications\GroupChangesNotification;
use App\Notifications\GroupSettingslNotification;
use Illuminate\Support\Facades\Notification;

class GroupChangesNotifyBuilder
{
    public function handle ($data)
    {

        $getAdmins = new GetAdminToNotify();

        $admins = $getAdmins->handle();

        Notification::send($admins, new GroupChangesNotification($data));
    }

}
