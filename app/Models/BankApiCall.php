<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankApiCall extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bank_api_calls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'account_number',
        'ifsc_code',
        'bank_name',
        'reference_id',
        'status',
        'decentro_txn_id',
        'response_code',
        'response_message',
        'bank_id',
        'api_response',
        'full_response_message',
    ];

    /**
     * Get the user that owns the API call.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the bank details associated with the API call.
     */
    public function bankDetails()
    {
        return $this->belongsTo(BankDetails::class, 'bank_id');
    }
}
