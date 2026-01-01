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
        ];
    
}
