<?php
// app/Listeners/TrackBankStatementUploaded.php

namespace App\Listeners;

use App\Events\BankStatementUploaded;
use App\Models\Event;
use App\Enums\EventTypeEnum;

class TrackBankStatementUploaded
{
    public function handle(BankStatementUploaded $event)
    {
        Event::create([
            'event_type' => EventTypeEnum::BANK_STATEMENT_UPLOADED->value,
            'user_id' => $event->user->id,
            'mobile_number' => $event->user->mobile ?? null,
            'name' => $event->user->name ?? null,
            'ip_address' => $event->ip,
            'device_type' => $event->device,
            'browser_details' => $event->browser,
            'interface' => $event->interface,
            'additional_data' => json_encode(['document_name' => $event->documentName]),
            'event_time' => now(),
        ]);
    }
}
