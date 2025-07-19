<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'select_customer',
        'select_anchor',
        'deal_period',
        'invoice_number',
        'deal_number',
        'deal_name',
        'invoice_value',
        'min_investment_amount',
        'deal_expiry_date',
        'invoice_date',
        'deal_due_date',
        'deal_live_date',
        'invoice_due_date',
        'deal_buffer_days',
        'yield_returns',
        'rumbble_score',
        'assign_crm',
        'status',
        'deal_status',
        'upload_invoice',
        'created_user_id',
        'updated_user_id',
        'repayment_date',
    ];


    protected $dates = [
        'invoice_date',
        'invoice_due_date',
        'deal_expiry_date',
        'deal_due_date',
        'payment_date',
        'investor_bank_update_date',
    ];

    public function getInvoiceDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getInvestorBankUpdateDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
    // Accessor for deal_due_date
    public function getDealDueDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    // Accessor for invoice_due_date
    public function getInvoiceDueDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    // public function getRepaymentDateAttribute($value)
    // {
    //     // Log the original value
    //     \Log::info('Repayment Date Value:', ['value' => $value]);
    
    //     // Check if the value is null, empty, or an invalid date
    //     if (is_null($value) || $value === '' || $value === '0000-00-00' || $value === '0000-00-00 00:00:00') {
    //         \Log::info('Invalid Date Detected:', ['value' => $value]);
    //         return ''; // Return a blank string for invalid dates
    //     }
    
    //     // Validate date format using a regular expression
    //     if (!preg_match('/\d{4}-\d{2}-\d{2}/', $value)) {
    //         \Log::info('Date Format Mismatch:', ['value' => $value]);
    //         return ''; // Return a blank string if the date does not match the expected format
    //     }
    
    //     try {
    //         // Log valid date parsing attempt
    //         \Log::info('Valid Date Detected:', ['value' => $value]);
    //         // Format the date only if it is valid
    //         return Carbon::parse($value)->format('d-m-Y');
    //     } catch (\Exception $e) {
    //         // Handle the case where the date parsing fails
    //         \Log::error('Date Parsing Failed:', ['value' => $value, 'exception' => $e->getMessage()]);
    //         return ''; // Return a blank string or handle the error as needed
    //     }
    // }
    
    // Accessor for deal_expiry_date
    public function getDealExpiryDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getPaymentDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'select_customer');
    }

    public function investor()
    {
        return $this->belongsTo(User::class, 'investor_id');
    }

    // public function getDealBufferDaysValAttribute()
    // {
    //     $dueDate = $this->deal_due_date;
    //     $currentDate = Carbon::now();
    //     return $dueDate->diffInDays($currentDate);
    // }

    public function getDealBufferDaysValAttribute()
    {
        // Convert $this->deal_due_date to a Carbon instance
        $dueDate = Carbon::parse($this->deal_due_date);

        // Get the current date as a Carbon instance
        $currentDate = Carbon::now();

        // Calculate the difference in days
        $daysDifference = $dueDate->diffInDays($currentDate);

        // Adjust the return value based on the comparison
        if ($dueDate < $currentDate) {
            return -$daysDifference; // Return negative days if due date is in the past
        } else {
            return $daysDifference; // Return positive days if due date is in the future or today
        }
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'deal_id', 'id');
    }

    public static function getDealsWithPaymentsForUser($userId)
    {
        return static::whereHas('payments', function ($query) use ($userId) {
            $query->where('status', 'captured')
                ->where('user_id', $userId);
        })
            ->with(['payments' => function ($query) {
                $query->where('status', 'captured');
            }])
            ->get();
    }

    public static function getDealsWithPaymentsForUserAll()
    {
        return static::whereHas('payments', function ($query) {
            $query->where('status', 'captured');
        })
            ->with(['payments' => function ($query) {
                $query->where('status', 'captured');
            }])
            ->get();
    }

    public static function getDealWithPayments($dealId, $userId)
    {
        return static::with(['payments' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->findOrFail($dealId);
    }

    public static function getDealWithPaymentsForAdmin($dealId, $userId)
    {
        return static::with('payments')->findOrFail($dealId);
    }


    public static function getDealsWithPaymentsForMIS()
    {
        return static::with(['payments' => function ($query) {
            $query->where('status', 'captured');
        }])->get();
    }

    public function bankDetails()
    {
        return $this->belongsTo(BankDetails::class, 'investor_bank_id', 'id');
    }

    public function bank()
    {
        return $this->belongsTo(BankDetails::class, 'investor_bank_id', 'id');
    }

    public function investorBankDetails()
    {
        return $this->belongsTo(BankDetails::class, 'investor_bank_id');
    }
}
