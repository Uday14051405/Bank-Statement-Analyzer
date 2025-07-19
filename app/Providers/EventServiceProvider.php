<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\UserOTPNotVerified;
use App\Events\UserOTPVerified;
use App\Events\BankStatementUploaded;
use App\Events\BankStatementSaved;
use App\Events\BankStatementAnalysisRun;
use App\Events\ReportDownloaded;
use App\Events\ContactUsSubmitted;
use App\Listeners\TrackUserOTPNotVerified;
use App\Listeners\TrackUserOTPVerified;
use App\Listeners\TrackBankStatementUploaded;
use App\Listeners\TrackBankStatementSaved;
use App\Listeners\TrackBankStatementAnalysisRun;
use App\Listeners\TrackReportDownloaded;
use App\Listeners\TrackContactUsSubmitted;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserOTPNotVerified::class => [
            TrackUserOTPNotVerified::class,
        ],
        UserOTPVerified::class => [
            TrackUserOTPVerified::class,
        ],
        BankStatementUploaded::class => [
            TrackBankStatementUploaded::class,
        ],
        BankStatementSaved::class => [
            TrackBankStatementSaved::class,
        ],
        BankStatementAnalysisRun::class => [
            TrackBankStatementAnalysisRun::class,
        ],
        ReportDownloaded::class => [
            TrackReportDownloaded::class,
        ],
        ContactUsSubmitted::class => [
            TrackContactUsSubmitted::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
