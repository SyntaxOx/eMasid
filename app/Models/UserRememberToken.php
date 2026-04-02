<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRememberToken extends Model
{
    protected $table = 'user_remember_tokens';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'token_hash',
        'user_agent',
        'ip_address',
        'expires_at',
        'last_used_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}