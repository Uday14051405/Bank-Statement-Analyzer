<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BsaDocument extends Model
{
    use HasFactory;

    protected $table = 'bsa_documents';
    protected $primaryKey = 'document_id';
    protected $fillable = [
        'user_id',
        'mobile_number',
        'bank_name',
        'file_name',
        'unique_file_name',
        'file_pwd',
        'document_url',
        'local_document_url',
        'password_protected',
        'uploaded_user',
        'status',
        'upload_status',
    ];

    // You can define relationships and other methods if needed
}
