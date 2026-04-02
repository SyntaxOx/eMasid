<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVerificationFile extends Model
{
    protected $table = 'user_verification_files';
    public $timestamps = false;

    protected $fillable = [
        'verification_id',
        'file_path',
        'original_name',
        'file_type',
        'file_size',
    ];

    // Belongs to one verification submission
    public function verification()
    {
        return $this->belongsTo(UserVerification::class, 'verification_id', 'id');
    }
}