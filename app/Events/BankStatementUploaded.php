<?php
// app/Events/BankStatementUploaded.php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\User;

class BankStatementUploaded
{
    use SerializesModels;

    public $user;
    public $ip;
    public $device;
    public $browser;
    public $interface;
    public $documentName;

    public function __construct(User $user, $ip, $device, $browser, $interface, $documentName)
    {
        $this->user = $user;
        $this->ip = $ip;
        $this->device = $device;
        $this->browser = $browser;
        $this->interface = $interface;
        $this->documentName = $documentName;
    }
}
