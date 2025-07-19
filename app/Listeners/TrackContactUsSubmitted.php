<?php
// app/Listeners/TrackContactUsSubmitted.php

namespace App\Listeners;

use App\Events\ContactUsSubmitted;
use App\Models\Event;
use App\Enums\EventTypeEnum;

class TrackContactUsSubmitted
{
    public function handle(ContactUsSubmitted $event)
    {
        Event::create([
            'event_type' => EventTypeEnum::CONTACT_US_SUBMITTED->value,
            'user_id' => $event->user->id,
            'ip_address' => $event->ip,
            'mobile_number' => $event->user->mobile ?? null,
            'name' => $event->user->name ?? null,
            'device_type' => $event->device,
            'browser_details' => $event->browser,
            'interface' => $event->interface,
            'additional_data' => json_encode(['message' => $event->message]),
            'event_time' => now(),
        ]);
    }
}
