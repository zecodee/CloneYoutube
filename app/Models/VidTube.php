<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VidTube extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'vid_tubes_id');
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class, 'vid_tubes_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'vid_tubes_id');
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class, 'vid_tubes_id');
    }
}
