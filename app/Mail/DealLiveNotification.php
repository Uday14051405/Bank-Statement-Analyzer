<?php
// app/Mail/DealLiveNotification.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DealLiveNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $deal;
    public $investor;
    public $amountsDeal;
   

    public function __construct($deal, $investor, $amountsDeal)
    {
        $this->deal = $deal;
        $this->investor = $investor;
        $this->amountsDeal = $amountsDeal;
    }

    public function build()
    {
        return $this->view('emails.deal-live-notification')
                    ->subject("Upcoming Deal: {$this->deal->deal_name}")
                    ->with([
                        'deal' => $this->deal,
                        'investor' => $this->investor,
                        'amountsDeal' => $this->amountsDeal
                    ]);

    }
}
