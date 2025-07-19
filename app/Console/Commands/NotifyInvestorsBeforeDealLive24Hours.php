<?php
// app/Console/Commands/NotifyInvestorsBeforeDealLive.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Deal;
use App\Models\User;
use App\Mail\DealLiveNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class NotifyInvestorsBeforeDealLive24Hours extends Command
{
    protected $signature = 'notify:investors-before-deal-live-24-hours';
    protected $description = 'Send email to active investors 24 hours before deal live date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();

        // Query the deals table to get deals going live within the next 24 hours
        $deals = Deal::whereBetween('deal_live_date', [$now, $now->copy()->addHours(24)])
            ->get();

        foreach ($deals as $deal) {
            // Format repayment and payment dates
            $formatted_repayment_date = $this->formatDate($deal->repayment_date);
            $formatted_payment_date = $this->formatDate($deal->payment_date);

            // Calculate amounts
            $deal_invoice_value = $deal->invoice_value ?? '0';
            $deal_period_days = $deal->calculateDaysToRepayment();
            $deal_yield_return = $deal->yield_returns ?? '0';
            $amountsDeal = $deal->calculateAmounts($deal_invoice_value, $deal_period_days, $deal_yield_return);

            $amountsDeal['formatted_repayment_date'] = $formatted_repayment_date;
            $amountsDeal['formatted_payment_date'] = $formatted_payment_date;

            $deal->maturityAmountDeal = $amountsDeal['maturity_amount'];
            $deal->repaymentAmountDeal = $amountsDeal['repayment_amount'];
            $deal->deal_period_days = $deal_period_days;

            // Get active investors (role_id = 7 and status = 1)
            $investors = User::where('role_id', 7)
                ->where('status', 1)
                ->whereIn('id', [162, 164]) // Adjust if needed
                ->get();

            foreach ($investors as $investor) {
                // Queue the email
                Mail::to($investor->email)->queue(new DealLiveNotification($deal, $investor, $amountsDeal));
            }
        }

        $this->info('Queued emails to active investors.');
    }

    /**
     * Format date with proper validation
     *
     * @param string|null $date
     * @return string
     */
    private function formatDate($date)
    {
        if (is_null($date) || $date === '' || $date === '0000-00-00 00:00:00') {
            return ''; // Assign blank string for invalid dates
        }

        try {
            return Carbon::parse($date)->format('d-m-Y');
        } catch (\Exception $e) {
            return ''; // Return blank string or handle the error as needed
        }
    }
}
