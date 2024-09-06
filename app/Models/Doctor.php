<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Doctor extends Model  implements HasMedia , TranslatableContract
{
    protected $table = 'doctors';

    use HasFactory;
    use InteractsWithMedia;
    use Translatable;
    use HasApiTokens , Notifiable;

    public $translatedAttributes = ['doctor_name' , 'doctor_address'];

   
    protected $fillable = [
        'year_of_experience',
        'membership_no',
        'country_id',
        'city_id',
        'email',
        'phone',
        'image',
        'hospital_id',
        'specialty_id',
        'rate',
        'review',
        'status'
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class,'specialty_id','id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }


    public function hospital()
    {
        return $this->belongsTo(Hospital::class,'hospital_id','id');
    } 

    public function projects()
    {
        return $this->hasMany(OtherProject::class,'doctor_id','id');
    }


}
