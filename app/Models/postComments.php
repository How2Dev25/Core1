<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class postComments extends Model
{
       use HasFactory, Notifiable;

       protected $table = 'postcomments';

       protected $primaryKey = 'postcommentID';

       protected $fillable = [
        'postcommentID',
        'postID',
        'commenterID',
        'commenter_role',
        'comment_image',
        'comment_content',
       ];

           public function post()
    {
        return $this->belongsTo(Posts::class, 'postID', 'postID');
    }
}
