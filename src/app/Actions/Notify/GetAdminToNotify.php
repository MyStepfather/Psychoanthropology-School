<?php

namespace App\Actions\Notify;

use App\Models\User;

class GetAdminToNotify
{
    public function handle() {
//        $user = User::find(1);
//        $admins[0] = $user;

        $admins = User::whereHas('roles', function($q)
        {
            $q->where('name', 'admin');
        })->get();

        return $admins;
    }
}
