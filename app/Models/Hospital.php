<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Hospital extends Model implements TranslatableContract , HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;
    

    protected $guard = 'Hospital';

    protected $table = 'hospitals';
    public $translatedAttributes = ['name', 'address', 'description'];

    protected $fillable = ['country_id','case_treated','surgery','medical_staff','bed','phone','email','image','status'];
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function insurances()
    {
        return $this->belongsToMany(Insurance::class);
    }
    public function centers()
    {
        return $this->belongsToMany(Center::class,'center_id','id');
    }
    
    // public function contractors()
    // {
    //     return $this->hasMany(Contractor::class,'hospital_id','id');
    // }

}