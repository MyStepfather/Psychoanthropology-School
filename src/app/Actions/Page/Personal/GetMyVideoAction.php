<?php

namespace App\Actions\Page\Personal;

use App\Constants\OrderStatus;
use App\Models\User;

class GetMyVideoAction
{
    public function handle($user, $category)
    {

        $video = User::find($user->id)
            ->orders()
            ->where('status', OrderStatus::PAID)
            ->whereHas('products', function ($query) use ($category) {
                $query->whereIn('category', $category);
            })
            ->get()
            ->flatMap(function ($order) {
                return $order->products;
            });

        return $video;
    }
}
