<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class inventoryPOS extends Model
{
      use HasFactory;

    protected $table = 'inventorypos'; 

    protected $primaryKey = 'inventoryposID';

    protected $fillable = [
        'inventoryposID',
        'reservationposID',
        'core1_inventoryID',
        'inventorypos_total',
        'inventorypos_quantity',
        'employeeID',
    ];

}
