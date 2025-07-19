<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpAttempt extends Model
{
    use HasFactory;

    protected $fillable = ['mobile', 'attempts', 'last_attempt_at'];
}
