<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type',
        'title',
        'address',
        'address_recipe',
        'lat_long',
        'city',
        'county',
    ];

    const TYPE_HOME = "home";
    const TYPE_WORK = "work";
    const TYPE_OTHER = "other";

    const TYPES = [
        self::TYPE_HOME,
        self::TYPE_WORK,
        self::TYPE_OTHER,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
