<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    protected $table = 'otp_codes';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'purpose',
        'code_hash',
        'channel',
        'expires_at',
        'used_at',
        'attempts',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}