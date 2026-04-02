<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSecurity extends Model
{
    protected $table = 'user_security';
    protected $primaryKey = 'user_id';
    public $incrementing = false; // user_id here is not auto-increment
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'two_factor_enabled',
        'two_factor_secret',
        'two_factor_verified_at',
        'failed_login_attempts',
        'last_failed_at',
        'lockout_until',
    ];

    // Belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}