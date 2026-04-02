<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLoginLog extends Model
{
    protected $table = 'user_login_logs';
    protected $primaryKey = 'log_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'identifier',
        'login_at',
        'logout_at',
        'ip_address',
        'user_agent',
        'status',
        'failure_reason',
        'session_token',
        'location',
        'via_remember_me',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}