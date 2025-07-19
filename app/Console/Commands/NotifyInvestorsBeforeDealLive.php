<?php
// app/Console/Commands/NotifyInvestorsBeforeDealLive.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Deal;
use App\Models\User;
use App\Mail\DealLiveNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class NotifyInvestorsBeforeDealLive extends Command
{
    protected $signature = 'notify:investors-before-deal-live';
    protected $description = 'Send email to active investors two hours before deal live date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();

        // Query the deals table
        // $deals = DB::table('deals')
        //     ->whereBetween('deal_live_date', [$now, $now->copy()->addHours(2)])
        //     ->get();

            //$deals = Deal::whereBetween('deal_live_date', [$now, $now->copy()->addHours(2)])
            //->get();

            $deals = Deal::whereBetween('deal_live_date', [$now, $now->copy()->addMinutes(12)])
    ->get();
               #$deals = Deal::get();

        foreach ($deals as $deal) {
            $deal->deal_live_status = 'Done'; // Update this status value as per your application's logic
            $deal->save();
            // Get active investors (role_id = 7 and status = 1)
            // $investors = User::where('role_id', 7)
            //                  ->where('status', 1)
            //                  ->get();


            if (is_null($deal->repayment_date) || $deal->repayment_date === '' || $deal->repayment_date === '0000-00-00 00:00:00') {
                $formatted_repayment_date = ''; // Assign blank string for invalid dates
            } else {
                try {
                    // Format the date if it is valid
                    $formatted_repayment_date = Carbon::parse($deal->repayment_date)->format('d-m-Y');
                } catch (\Exception $e) {
                    // Handle the case where the date parsing fails
                    $formatted_repayment_date = ''; // Return blank string or handle the error as needed
                }
            }
    
            // Format the repayment_date if it's valid
            if (is_null($deal->payment_date) || $deal->payment_date === '' || $deal->payment_date === '0000-00-00 00:00:00') {
                $formatted_payment_date = ''; // Assign blank string for invalid dates
            } else {
                try {
                    // Format the date if it is valid
                    $formatted_payment_date = Carbon::parse($deal->payment_date)->format('d-m-Y');
                } catch (\Exception $e) {
                    // Handle the case where the date parsing fails
                    $formatted_payment_date = ''; // Return blank string or handle the error as needed
                }
            }

            if (is_null($deal->deal_live_date) || $deal->deal_live_date === '' || $deal->deal_live_date === '0000-00-00 00:00:00') {
                $formatted_deal_live_date = ''; // Assign blank string for invalid dates
            } else {
                try {
                    // Format the date if it is valid
                    $formatted_deal_live_date = Carbon::parse($deal->deal_live_date)->format('d-m-Y H:i:s');
                } catch (\Exception $e) {
                    // Handle the case where the date parsing fails
                    $formatted_deal_live_date = ''; // Return blank string or handle the error as needed
                }
            }
            $deal_invoice_value = $deal->invoice_value ?? '0';
            $deal_period_days = $deal->calculateDaysToRepayment();
            $deal_yield_return = $deal->yield_returns ?? '0';
            $amountsDeal = $deal->calculateAmounts($deal_invoice_value, $deal_period_days, $deal_yield_return); // Example values
    
            $maturityAmountDeal = $amountsDeal['maturity_amount'];
            $repaymentAmountDeal = $amountsDeal['repayment_amount'];
            #dd($deal);
            $amountsDeal['formatted_repayment_date'] = $formatted_repayment_date;
            $amountsDeal['formatted_payment_date'] = $formatted_payment_date;
            $amountsDeal['formatted_deal_live_date'] = $formatted_deal_live_date;
            // $amountsDeal['maturityAmountDeal'] = $maturityAmountDeal;
            // $amountsDeal['maturityAmountDeal'] = $maturityAmountDeal;

            $deal->maturityAmountDeal = $maturityAmountDeal;
            $deal->repaymentAmountDeal = $repaymentAmountDeal;
            $deal->deal_period_days = $deal_period_days;
            #dd($deal);
            $investors = User::where('role_id', 7)
                 ->where('status', 1)
                // ->whereIn('id', [162, 164])
                 ->get();


            foreach ($investors as $investor) {
                // Send email using queue
                #dd($amountsDeal);
                Mail::to($investor->email)->queue(new DealLiveNotification($deal, $investor, $amountsDeal));
            }


          

        }

        $this->info('Queued emails to active investors.');
    }
}
