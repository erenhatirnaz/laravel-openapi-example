<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function login()
    {
        $token = new Token();
        $token->token = Uuid::uuid4()->toString();
        $token->user()->associate($this);
        $token->save();

        return $token->fresh();
    }
}
