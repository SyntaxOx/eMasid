<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAppeal extends Model
{
    protected $table = 'user_appeals';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'type',
        'message',
        'attachment',
        'status',
        'reviewed_by',
        'reviewed_at',
        'admin_response',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by', 'user_id');
    }
}