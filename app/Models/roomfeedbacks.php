<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;
class roomfeedbacks extends Model
{

       use HasFactory, Notifiable, Syncable;

       protected $table = 'core1_roomfeedback';

       protected $primaryKey = 'roomfeedbackID';

       protected $fillable = [
        'roomfeedbackID',
        'roomID',
        'guestID',
        'roomrating',
        'roomfeedbackdate',
        'roomfeedbackfeedback',
        'roomfeedbackstatus',
        'roomrating',
        'roomfeedbackresponse',
        'roomfeedbackphoto'
       ];
    
}
