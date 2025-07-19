<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BankDisputeRaised extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $bankdata;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $bankdata)
    {
        $this->user = $user;
        $this->bankdata = $bankdata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Dispute Raised for Bank Account')
                    ->view('emails.bank_dispute');
    }
}
