<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'credit_card_no',
        'credit_bank_name',
        'account_holder_name',
        'bank_name',
        'ifsc_code',
        'bank_id',
        'account_number',
        'nick_name',
        'cheque_passbook',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
