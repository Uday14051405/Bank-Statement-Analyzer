<?php
// app/Models/Event.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type',
        'location',
        'ip_address',
        'event_time',
        'user_id',
        'device_type',
        'browser_details',
        'interface',
        'additional_data',
        'mobile_number',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
