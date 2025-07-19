<?php
// app/Events/ContactUsSubmitted.php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ContactUsSubmitted
{
    use SerializesModels;

    public $user;
    public $ip;
    public $device;
    public $browser;
    public $interface;
    public $message;

    public function __construct(User $user, $ip, $device, $browser, $interface, $message)
    {
        $this->user = $user;
        $this->ip = $ip;
        $this->device = $device;
        $this->browser = $browser;
        $this->interface = $interface;
        $this->message = $message;
    }
}
