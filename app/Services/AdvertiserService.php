<?php

namespace App\Services;

use App\Models\Advertiser;
use App\Notifications\UpcomingAd;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class AdvertiserService
{

    public function notifyAdvertisersWithUpcomingAds()
    {
        Notification::send($this->getAdvertisersWithUpcomingAds(), new UpcomingAd());
    }

    public function getAdvertisersWithUpcomingAds()
    {
        return Advertiser::query()
            ->whereHas('ads', function ($query) {
                $query->whereDate('start_date', '=', Carbon::tomorrow());
            })->get();
    }

}