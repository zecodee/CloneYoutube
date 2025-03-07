<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'level', 'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function video()
    {
        return $this->hasMany(VidTube::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function playlists()
    {
        return $this->hasMany(Like::class);
    }

    public function subscribe()
    {
        return $this->hasMany(Subscribe::class, 'user_id','id');
    }

    public function subscriber()
    {
        return $this->hasMany(Subscriber::class, 'subscribed_id','id');
    }

    public function subscriberCount()
    {
        return $this->subscriber()->count();
    }

    public function subscribeCount()
    {
        return $this->subscribe()->count();
    }

    protected $appends = ['subscriberCount'];
}
