<?php

namespace App\Libraries;

use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\Cache;

class TimeZoneLib
{

    static function timezoneOptions(?string $locale = null): array
    {
        return Cache::remember('TimeZoneLib_timezoneOptions_'.($locale ?? ''), 60 * 60 * 480,
            function() use ($locale)
            {
                $now = Carbon::now('UTC');
                $ids = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                // Optional: filter out technical zones you don’t want to show
                $ids = array_values(array_filter($ids, function($id)
                {
                    return !str_starts_with($id, 'Etc/') && !str_starts_with($id, 'posix/') && !str_starts_with($id, 'right/');
                }));

                $options = [];
                foreach($ids as $id)
                {
                    $tz = new DateTimeZone($id);
                    $offsetSeconds = $tz->getOffset($now);
                    $sign = $offsetSeconds >= 0 ? '+' : '-';
                    $abs = abs($offsetSeconds);
                    $hours = floor($abs / 3600);
                    $mins = floor(($abs % 3600) / 60);
                    $offset = sprintf('UTC%s%02d:%02d', $sign, $hours, $mins);

                    // Basic label: "(UTC+08:00) Asia/Shanghai"
                    $label = sprintf('(%s) %s', $offset, $id);

                    $options[] = [
                        'value' => $id,
                        'label' => $label,
                        'group' => strtok($id, '/'), // e.g., "Asia"
                    ];
                }

                // Sort by offset then by label
                usort($options, function($a, $b)
                {
                    return strcmp($a['label'], $b['label']);
                });

                return $options;
            }
        );
    }
}
