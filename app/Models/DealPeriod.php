<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealPeriod extends Model
{
    use HasFactory;

    protected $table = 'deal_period';

    protected $fillable = ['value'];
}
