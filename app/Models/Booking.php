<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'doctor_id',
        'doctor_hospital_id',
        'doctor_clinic_id',
        'day_id',
        'date',
        'form',
        'to',
        'status'
    ]; 
    public function DoctorClinic()
    {
        return $this->belongsTo(Clinic::class,'doctor_clinic_id','id');
    } 
    public function DoctorHospital()
    {
        return $this->belongsTo(Hospital::class,'doctor_hospital_id','id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id','id');
    }
    // public function hospital()
    // {
    //     return $this->belongsTo(Hospital::class,'hospital_id','id');
    // }
    // public function clinic()
    // {
    //     return $this->belongsTo(Clinic::class,'clinic_id','id');
    // }

    public function day()
    {
        return $this->belongsTo(Day::class,'day_id','id');
    }
}