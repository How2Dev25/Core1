<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $primaryKey = 'likeID';
    protected $fillable = ['postID', 'guestID'];

    // Like belongs to a post
    public function post()
    {
        return $this->belongsTo(Posts::class, 'postID', 'postID');
    }

    // Like belongs to a guest
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guestID', 'guestID');
    }
}