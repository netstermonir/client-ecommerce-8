<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickuppoint extends Model
{
    use HasFactory;
    protected $table = 'pickup_points';
    protected $fillable = ["pickup_point_name", "pickup_point_address", "pickup_point_phone"];
}
