<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Token extends Model
{
    use SoftDeletes;

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
