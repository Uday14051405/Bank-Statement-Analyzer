<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonFunctionController extends Controller
{
    public static function calculateAmounts($invoiceValue, $dealPeriod, $yieldReturns)
    {
        // Ensure the inputs are numeric
        $invoiceValue = is_numeric($invoiceValue) ? (float) $invoiceValue : 0;
        $dealPeriod = is_numeric($dealPeriod) ? (float) $dealPeriod : 0;
        $yieldReturns = is_numeric($yieldReturns) ? (float) $yieldReturns : 0;

        // Calculate interest
        $interest = ($invoiceValue * $yieldReturns * $dealPeriod) / 36500;

        // Calculate maturity amount (principal + interest)
        $maturityAmount = $invoiceValue + $interest;

        $tds = $interest * 0.1;

        // Calculate repayment amount (maturity amount - 10% of interest)
        $repaymentAmount = $maturityAmount - $tds;

        // Return the calculated amounts
        return [
            'maturity_amount' => round($maturityAmount, 2),
            'repayment_amount' => round($repaymentAmount, 2),
            'tds_amount' => round($tds, 2),
        ];
    }
}
