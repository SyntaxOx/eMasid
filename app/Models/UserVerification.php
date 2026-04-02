<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    protected $table = 'user_verifications';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'document_type',
        'status',
        'reviewed_by',
        'reviewed_at',
        'rejection_reason',
    ];

    // Who submitted this verification
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Who reviewed it (an admin, also a User)
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by', 'user_id');
    }

    // The uploaded files attached to this verification
    public function files()
    {
        return $this->hasMany(UserVerificationFile::class, 'verification_id', 'id');
    }
}