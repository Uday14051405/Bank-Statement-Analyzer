<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BsaReport extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bsa_reports';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doc_ids',
        'request_payload',
        'response_payload',
        'status',
        'report_id',
        'report_url',
        'is_sms_link_active',
        'mobile_number',
        'downloaded_at',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'doc_ids' => 'array',
        'request_payload' => 'array',
        'response_payload' => 'array',
        'is_sms_link_active' => 'boolean',
        'downloaded_at' => 'datetime',
    ];
}
