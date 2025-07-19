<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, Loggable;

    // protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'image',
        'status',
        'role_id',
        'annual_turnover',
        'assign_crm',
        'bank_name',
        'other_comments',
        'company_name',
        'photo',
        'pan_number',
        'pan_name',
        'gst',
        'account_holder_name',
        'account_number',
        'ifsc_code',
        'cheque_pass',
        'credit_card_no',
        'credit_bank_name',
        'nick_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getRoleCodes()
    {
        $user = Auth::user();
        return $roles = Role::where('name', $user->getRoleNames())->get();
    }

    public function getUserDetails()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'role' => implode(', ', $this->getRoleNames()->toArray()),
            'status' => $this->status,
            'created_at' => $this->created_at ? $this->created_at->format('jS M Y') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('jS M Y') : null,
            'annual_turnover' => $this->annual_turnover,
            'assign_crm' => $this->assign_crm,
            'other_comments' => $this->other_comments,
            'company_name' => $this->company_name,
            'pan_card' => $this->pan_card,
            'aadhar_card' => $this->aadhar_card,
            'pan_number' => $this->pan_number,
            'pan_name' => $this->pan_name,
            'gst' => $this->gst,
            'account_holder_name' => $this->account_holder_name,
            'bank_name' => $this->bank_name,
            'account_number' => $this->account_number,
            'ifsc_code' => $this->ifsc_code,
            'image' => $this->image_url,
            'cheque_pass' => $this->cheque_pass,

        ];
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && !empty($this->image)) {
            return asset($this->image);
        } else {
            return asset('/assets/admin/img/default-user.png');
        }
    }

    public function getChequePassAttribute()
    {
        if (isset($this->attributes['cheque_pass']) && !empty($this->attributes['cheque_pass'])) {
            return asset('storage/' . $this->attributes['cheque_pass']);
        } else {
            #return asset('/assets/admin/img/default-user.png');
            return '';
        }
    }
    
    public function anchors()
    {
        return $this->belongsToMany(User::class, 'customer_anchor', 'customer_id', 'anchor_id');
    }

    // Define the relationship for customers who have anchors
    public function customers()
    {
        return $this->belongsToMany(User::class, 'customer_anchor', 'anchor_id', 'customer_id');
    }


}
