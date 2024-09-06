<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
class Insurance extends Model implements HasMedia , TranslatableContract
{
    use HasFactory;
    use Translatable;
    use InteractsWithMedia;

    public $translatedAttributes = ['name'];
    protected $fillable = [
        'insurance_section_id',
        'hospital_id',
        'image',
        'status'
    ];
    public function add_insurances()
    {
        return $this->hasMany(AddInsurance::class, 'insurance_id', 'id');
    }
    public function insurance_section()
    {
        return $this->belongsTo(InsuranceSection::class, 'insurance_section_id', 'id');
    }

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class)->withTimestamps();;
    }

}