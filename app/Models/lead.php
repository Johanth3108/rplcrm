<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lead extends Model
{
    use HasFactory;

    public static function assigned($prop_name){
        echo((lead::where('property_name', $prop_name)->first()));
        return lead::where('property_name', $prop_name)->first();
    }
}
