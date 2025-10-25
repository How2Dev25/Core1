<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class additionalinfoadmin extends Model
{
     use HasFactory, Notifiable;

     protected $table = 'additionalinfoadmin';

     protected $primaryKey = 'additionalinfoadminID';

     protected $fillable = [
        'additionalinfoadminID',
        'Dept_no',
        'adminphoto',
        
     ];

     
}
