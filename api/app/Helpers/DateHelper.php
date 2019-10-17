<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    /**
     * タイムスタンプを返す
     *
     * @param Carbon|string|null $date
     * @return string|null
     */
    public static function getTimestamp($date): ?string
    {
        if (is_null($date)) {
            return null;
        }

        if (!$date instanceof Carbon) {
            $date = Carbon::create($date);
        }

        return $date->format(config('api.timestamp_format'));
    }
}
