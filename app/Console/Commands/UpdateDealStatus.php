<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateDealStatus extends Command
{
    protected $signature = 'deals:update-status';
    protected $description = 'Update deal status to Expired where deal_due_date is less than or equal to the current date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DB::table('deals')
            ->where('deal_due_date', '<=', now())
            ->update(['status' => 'Expired']);

        $this->info('Deal statuses updated successfully.');
    }
}
