<?php
// app/Listeners/TrackUserOTPNotVerified.php

namespace App\Listeners;

use App\Events\UserOTPNotVerified;
use App\Models\Event;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TrackUserOTPNotVerified
{
    public function handle(UserOTPNotVerified $event)
    {
        
        $eventRecord = Event::create([
            'user_id' => $event->user->id ?? null,
            'mobile_number' => $event->mobile ?? null,
            'name' => $event->user->name ?? null,
            'event_type' =>  \App\Enums\EventTypeEnum::OTP_NOT_VERIFIED->value,
            'ip_address' => $event->ip,
            'device_type' => $event->device,
            'browser_details' => $event->browser,
            'interface' => $event->interface,
            'event_time' => now(),
        ]);

        // Make the event ID accessible
        return $eventRecord->id;
    }
}
