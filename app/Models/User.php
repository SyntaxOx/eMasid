<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = true;

    protected $fillable = [
        'resident_id',
        'brgy_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'gender',
        'full_address',
        'mobile_number',
        'email',
        'password_hash',
        'last_password_changed',
        'email_verified_at',
        'is_verified',
        'verified_at',
        'status',
        'restricted_access',
    ];

    // Columns to hide when converting to JSON (e.g. API responses)
    protected $hidden = [
        'password_hash',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // ---- Relationships ----

    // A user belongs to one barangay
    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'brgy_id', 'brgy_id');
    }

    // A user has one security record
    public function security()
    {
        return $this->hasOne(UserSecurity::class, 'user_id', 'user_id');
    }

    // A user has many remember tokens
    public function rememberTokens()
    {
        return $this->hasMany(UserRememberToken::class, 'user_id', 'user_id');
    }

    // A user has many verification submissions
    public function verifications()
    {
        return $this->hasMany(UserVerification::class, 'user_id', 'user_id');
    }

    // A user has many appeals
    public function appeals()
    {
        return $this->hasMany(UserAppeal::class, 'user_id', 'user_id');
    }

    // A user has many login logs
    public function loginLogs()
    {
        return $this->hasMany(UserLoginLog::class, 'user_id', 'user_id');
    }

    // A user has many OTP codes
    public function otpCodes()
    {
        return $this->hasMany(OtpCode::class, 'user_id', 'user_id');
    }

    // A user has many status history records
    public function statusHistory()
    {
        return $this->hasMany(UserStatusHistory::class, 'user_id', 'user_id');
    }
}