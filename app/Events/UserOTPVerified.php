<?php
// app/Events/UserOTPVerified.php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserOTPVerified
{
    use SerializesModels;

    public $user;
    public $ip;
    public $device;
    public $browser;
    public $interface;
    public $mobile;
    public $eventIdInput;

    public function __construct($user, $ip, $device, $browser, $interface, $mobile, $eventIdInput)
    {
        $this->user = $user;
        $this->ip = $ip;
        $this->device = $device;
        $this->browser = $browser;
        $this->interface = $interface;
        $this->mobile = $mobile;
        $this->eventIdInput = $eventIdInput;
        
    }
}
