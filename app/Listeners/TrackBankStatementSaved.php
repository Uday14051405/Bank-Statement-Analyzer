<?php
// app/Listeners/TrackBankStatementSaved.php

namespace App\Listeners;

use App\Events\BankStatementSaved;
use App\Models\Event;
use App\Enums\EventTypeEnum;

class TrackBankStatementSaved
{
    public function handle(BankStatementSaved $event)
    {
        Event::create([
            'event_type' => EventTypeEnum::BANK_STATEMENT_SAVED->value,
            'user_id' => $event->user->id,
            'mobile_number' => $event->user->mobile ?? null,
            'name' => $event->user->name ?? null,
            'ip_address' => $event->ip,
            'device_type' => $event->device,
            'browser_details' => $event->browser,
            'interface' => $event->interface,
            'additional_data' => json_encode(['password_saved' => $event->passwordSaved]),
            'event_time' => now(),
        ]);
    }
}
