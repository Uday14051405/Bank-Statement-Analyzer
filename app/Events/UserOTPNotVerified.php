<?php
// app/Events/UserOTPNotVerified.php
namespace App\Events;

use Illuminate\Queue\SerializesModels;

class UserOTPNotVerified
{
    use SerializesModels;

    public $user;
    public $ip;
    public $device;
    public $browser;
    public $interface;
    public $mobile;

    public function __construct($user, $ip, $device, $browser, $interface, $mobile)
    {
        $this->user = $user;
        $this->ip = $ip;
        $this->device = $device;
        $this->browser = $browser;
        $this->interface = $interface;
        $this->mobile = $mobile;
        
    }
}
