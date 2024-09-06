<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterHospital extends Model
{
    use HasFactory;
    protected $fillable = [
        'hospital_id',
        'center_id',
    ];
}
