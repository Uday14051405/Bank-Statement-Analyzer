<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class AcknowledgementMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $deal;
    public $payment_data_val;
    public $pdfAttachments;
    public $other_data;
    public $companyDetail;

    public function __construct($user, $payment_data_val, $deal, $pdfAttachments, $other_data, $companyDetail)
    {
        $this->user = $user;
       
        $this->payment_data_val = $payment_data_val;
        $this->deal = $deal;
        $this->pdfAttachments = $pdfAttachments;
        $this->other_data =$other_data;
        $this->companyDetail =$companyDetail;
    }

    public function build()
    {
        // $email = $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))->subject('Rumbble - Acknowledgement of your online payment')
        //               ->view('emails.acknowledgement')
        //               ->with('user', $this->user);

        $email = $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                  ->subject('Rumbble - Acknowledgement of your online payment')
                  ->view('emails.acknowledgement')
                  ->with([
                      'user' => $this->user,
                      'payment_data' => $this->payment_data_val,
                      'deal' => $this->deal,
                      'other_data' => $this->other_data,
                      'companyDetail' => $this->companyDetail,
                  ]);

        // Attach PDFs if they exist
        // if (isset($this->pdfAttachments['privacy_policy']) && Storage::exists($this->pdfAttachments['privacy_policy'])) {
        //     $email->attach(Storage::path($this->pdfAttachments['privacy_policy']), [
        //         'as' => 'Privacy_Policy.pdf',
        //         'mime' => 'application/pdf',
        //     ]);
        // } else {
        //     Log::warning('Privacy Policy PDF not found.');
        // }

        // if (isset($this->pdfAttachments['terms_conditions']) && Storage::exists($this->pdfAttachments['terms_conditions'])) {
        //     $email->attach(Storage::path($this->pdfAttachments['terms_conditions']), [
        //         'as' => 'Terms_Conditions.pdf',
        //         'mime' => 'application/pdf',
        //     ]);
        // } else {
        //     Log::warning('Terms & Conditions PDF not found.');
        // }

        if (isset($this->pdfAttachments['agreement']) && Storage::exists($this->pdfAttachments['agreement'])) {
            $email->attach(Storage::path($this->pdfAttachments['agreement']), [
                'as' => 'Agreement.pdf',
                'mime' => 'application/pdf',
            ]);
        } else {
            Log::warning('Terms & Conditions PDF not found.');
        }


        return $email;
    }
}
