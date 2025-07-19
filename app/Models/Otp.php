<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = ['mobile', 'otp', 'expires_at', 'session_id'];

    // You can add further functions related to OTPs here if needed
}
