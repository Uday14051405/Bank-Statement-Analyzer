<?php
// app/Listeners/TrackBankStatementAnalysisRun.php

namespace App\Listeners;

use App\Events\BankStatementAnalysisRun;
use App\Models\Event;
use App\Enums\EventTypeEnum;

class TrackBankStatementAnalysisRun
{
    public function handle(BankStatementAnalysisRun $event)
    {
        Event::create([
            'event_type' => EventTypeEnum::BANK_STATEMENT_ANALYSIS_RUN->value,
            'user_id' => $event->user->id,
            'mobile_number' => $event->user->mobile ?? null,
            'name' => $event->user->name ?? null,
            'ip_address' => $event->ip,
            'device_type' => $event->device,
            'browser_details' => $event->browser,
            'interface' => $event->interface,
            'event_time' => now(),
        ]);
    }
}
