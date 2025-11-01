<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'image', 'caption'];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Relasi ke comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Check apakah user sudah like
    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }
}
