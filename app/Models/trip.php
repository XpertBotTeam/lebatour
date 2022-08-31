<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trip extends Model
{
    use HasFactory;
    protected $fillable = [
        	'user_id',
            'thumbnail',	
            'title',	
            'description',	
            'priceperperson',
            'Days',	
            'time',	
            'adminDistrict',	
            'city',	
            'postalcode',	
            'adressline',	
            'longitude',	
            'latitude',	
    ];
}
