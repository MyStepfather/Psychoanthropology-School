<?php

namespace App\Actions\Subscribes;

use App\Constants\OrderStatus;
use App\Constants\ProductCategories;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class GetSubscribesAction
{
    /**
     * @param $period - [
     * 'year' => ..int..date('Y') .. example 2023,
     * 'month' => ..int...date('n') example 8,
     * ] or 'active' or 'all'
     *
     * $subject = SubscribesTypes
     * @return mixed|void
     */
    public function handle($user, $subject, $period)
    {
        if ($period === 'active') {
            $subscription = $user->orders()->paid()
                ->whereHas('products', function ($query) use ($subject) {
                    $query->whereIn('category', [ProductCategories::SUBSCRIPTION])
                        ->whereIn('code', $subject);
                })
                ->with(['products' => function ($query)  {
                    $query->whereIn('category', [ProductCategories::SUBSCRIPTION])
                        ->wherePivot('date_start', '<=', now())
                        ->wherePivot('date_end', '>=', now());
                }])
                ->get()
                ->flatMap(function ($order) {
                    return $order->products;
                })
                ->first();

            return $subscription;
        }

        if ($period === 'all') {
            $subscriptions =  $user
                ->orders()->paid()
                ->whereHas('products', function ($query) use ($subject) {
                    $query->whereIn('category', [ProductCategories::SUBSCRIPTION])
                        ->whereIn('code', $subject);
                })
                ->get()
                ->flatMap(function ($order) {
                    return $order->products;
                });

            return $subscriptions;
        }

        if (is_array($period)) {

            $startDate = Carbon::createFromDate($period['year'], $period['month'], 1)->startOfMonth();
            $endDate = $startDate->copy()->endOfMonth();

            $subscription = $user->orders()
                ->whereStatus(OrderStatus::PAID)
//                ->paid() не работает
                ->whereHas('products', function ($query) use ($subject) {
                    $query->whereIn('category', [ProductCategories::SUBSCRIPTION])
                        ->whereIn('code', $subject);
                })
                ->with(['products' => function ($query) use ($endDate, $startDate) {
                    $query->whereIn('category', [ProductCategories::SUBSCRIPTION])
                        ->wherePivot('date_start', '<=', $endDate)
                        ->wherePivot('date_end', '>=', $startDate);
                }])
                ->get()
                ->flatMap(function ($order) {
                    return $order->products;
                })
                ->first();

            return $subscription;
        }

    }
}
