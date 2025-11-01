<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'bio'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke posts
    public function posts()
    {
        return $this->hasMany(Post::class);
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

    // Relasi followers (yang follow user ini)
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    // Relasi following (yang di-follow user ini)
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    // Check apakah user sudah follow
    public function isFollowing($userId)
    {
        return $this->following()->where('following_id', $userId)->exists();
    }
}
