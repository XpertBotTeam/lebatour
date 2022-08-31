<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'total_amount',
        'user_id',
        'trip_id',
        'number_of_person',	
        'bank_transaction_id',     
];
}
