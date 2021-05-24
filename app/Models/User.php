<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'nick',
        'adress',
        'postal_code',
        'city',
        'phone_number',
        'email',
        'password',
        'google_id',
        'avatar'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function like(){
        return $this->hasMany(Like::class);
    }
    public function wine(){
        return $this->hasMany(Wine::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function favourites(){
        return $this->hasMany(Favourite::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function isAdmin()
    {
        return $this->id==1;
    }
}
