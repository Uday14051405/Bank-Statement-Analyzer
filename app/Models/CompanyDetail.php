<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    use HasFactory;

    protected $table = 'company_details';

    protected $fillable = [
        'name',
        'designation',
        'address',
        'email',
        'account_name',
        'account_number',
        'ifsc_code',
        'bank_name',
        'branch',
        'company_name',
        'cin',
        'company_address',
    ];

    public static function getCompanyDetails()
    {
        $companyId = env('COMPANY_ID');
        return self::find($companyId);
    }
}
