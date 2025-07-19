<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SignupThankYouMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $pdfAttachments;
    public $companyDetail;

    public function __construct($user, $pdfAttachments, $companyDetail)
    {
        $this->user = $user;
        $this->pdfAttachments = $pdfAttachments;
        $this->companyDetail = $companyDetail;
    }

    public function build()
    {
        $email = $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))->subject('Rumbble - Our Terms of Service and Privacy Policy')
                      ->view('emails.signup_thank_you')
                      #->with('user', $this->user);
                      ->with([
                        'user' => $this->user,
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
