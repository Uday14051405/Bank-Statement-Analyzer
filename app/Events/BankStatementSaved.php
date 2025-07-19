<?php
// app/Events/BankStatementSaved.php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\User;

class BankStatementSaved
{
    use SerializesModels;

    public $user;
    public $ip;
    public $device;
    public $browser;
    public $interface;
    public $passwordSaved;

    public function __construct(User $user, $ip, $device, $browser, $interface, $passwordSaved)
    {
        $this->user = $user;
        $this->ip = $ip;
        $this->device = $device;
        $this->browser = $browser;
        $this->interface = $interface;
        $this->passwordSaved = $passwordSaved;
    }
}
