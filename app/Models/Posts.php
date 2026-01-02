<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Posts extends Model
{
        use HasFactory, Notifiable;

        protected $table = 'posts';
        
        protected $primaryKey =  'postID';

        protected $fillable = [
            'postID',
            'guestID',
            'post_content',
            'post_image',
            'post_video',
            'post_role',
        ];

         public function likes()
    {
        return $this->hasMany(Like::class, 'postID', 'postID');
    }

    // Count likes
    public function likesCount()
    {
        return $this->likes()->count();
    }

    // Check if a guest liked this post
    public function isLikedBy($guestID)
    {
        return $this->likes()->where('guestID', $guestID)->exists();
    }

      public function comments()
    {
        return $this->hasMany(postComments::class, 'postID', 'postID');
    }
    
}
