<?php
// app/Events/ReportDownloaded.php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ReportDownloaded
{
    use SerializesModels;

    public $user;
    public $ip;
    public $device;
    public $browser;
    public $interface;

    public function __construct(User $user, $ip, $device, $browser, $interface)
    {
        $this->user = $user;
        $this->ip = $ip;
        $this->device = $device;
        $this->browser = $browser;
        $this->interface = $interface;
    }
}
