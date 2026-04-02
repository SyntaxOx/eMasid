<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    // Tells Laravel the exact table name
    protected $table = 'barangay';

    // Tells Laravel our primary key is not the default 'id'
    protected $primaryKey = 'brgy_id';

    // This table has no created_at / updated_at columns
    public $timestamps = false;

    // These are the columns you're allowed to fill/save
    protected $fillable = [
        'brgy_name',
        'municipality',
        'province',
        'region',
        'zip_code',
    ];

    // One barangay has many users
    public function users()
    {
        return $this->hasMany(User::class, 'brgy_id', 'brgy_id');
    }
}