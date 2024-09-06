<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements HasMedia , TranslatableContract
{
    use SoftDeletes;
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;
    public $translatedAttributes = ['name','address','description','words_guide','about','privacy','terms','why_hospital','path_to_success' ,'sustainability' ,'hospital_policies' ,'management_team'];
    protected $fillable = ['language','logo','favicon','phone','email','location','whatsapp','facebook','twitter','instagram','youtube','linkedin','video','number_of_consultants' ,'number_of_medical_team','number_of_beds' , 'number_of_patients','sustainability_report' , 'whistleblowing_policy' , 'internal_rules_of_conduct', 'supplier_code_of_conduct'];
}