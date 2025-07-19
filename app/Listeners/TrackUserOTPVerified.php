<?php

namespace App\Listeners;

use App\Events\UserOTPVerified;
use App\Models\Event;
use App\Enums\EventTypeEnum;

class TrackUserOTPVerified
{
    public function handle(UserOTPVerified $event)
    {
        // Check if the event ID is passed (from frontend or other logic)
        $eventIdInput = request()->input('event_id'); // Ensure this is passed from the frontend

        if (!empty($eventIdInput)) {
            // Update the existing event if event ID is provided
            $existingEvent = Event::find($eventIdInput);

            if ($existingEvent) {
                $existingEvent->update([
                    'event_type' => EventTypeEnum::OTP_VERIFIED->value,
                    'event_time_update' => now(),
                    'name' => $event->user->name ?? null,
                    'user_id' => $event->user->id ?? null,
                ]);
            }
        } else {
            // Create a new event record if no event ID is provided
            Event::create([
                'user_id' => $event->user->id ?? null,
                'mobile_number' => $event->mobile ?? null,
                'name' => $event->user->name ?? null,
                'event_type' => EventTypeEnum::OTP_VERIFIED->value,
                'ip_address' => $event->ip,
                'device_type' => $event->device,
                'browser_details' => $event->browser,
                'interface' => $event->interface,
                'event_time' => now(),
            ]);
        }
    }
}
