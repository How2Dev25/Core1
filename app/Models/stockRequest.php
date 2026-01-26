<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;

class stockRequest extends Model
{
     use HasFactory, Notifiable, Syncable;

     protected $table = 'core1_stockrequest';

     protected $primaryKey = 'core1_stockID';

     protected $fillable = [
        'core1_stockID',
        'core1_requestID',
        'core1_request_items',
        'core1_request_status',
        'core1_request_category',
        'core1_request_priority',
        'core1_request_needed',
     ];


}
