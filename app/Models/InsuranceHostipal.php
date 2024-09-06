<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceHostipal extends Model
{
    use HasFactory;

    protected $fillable = [
        'insurance_id',
        'hospital_id',
        
    ];

    // public function hospital()
    // {
    //     return $this->belongsTo(Hospital::class,'hospital_id','id');
    // }
    // public function insurance()
    // {
    //     return $this->belongsTo(Insurance::class,'insurance_id','id');
    // }
}
