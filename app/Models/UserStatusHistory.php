<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStatusHistory extends Model
{
    protected $table = 'user_status_history';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'changed_by',
        'old_status',
        'new_status',
        'reason',
    ];

    // The user whose status changed
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // The admin who changed it
    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by', 'user_id');
    }
}