<?php
// app/Listeners/TrackReportDownloaded.php

namespace App\Listeners;

use App\Events\ReportDownloaded;
use App\Models\Event;
use App\Enums\EventTypeEnum;

class TrackReportDownloaded
{
    public function handle(ReportDownloaded $event)
    {
        Event::create([
            'event_type' => EventTypeEnum::BSA_REPORT_DOWNLOADED->value,
            'user_id' => $event->user->id,
            'ip_address' => $event->ip,
            'mobile_number' => $event->user->mobile ?? null,
            'name' => $event->user->name ?? null,
            'device_type' => $event->device,
            'browser_details' => $event->browser,
            'interface' => $event->interface,
            'event_time' => now(),
        ]);
    }
}
