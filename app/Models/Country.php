<?php

namespace App\Models;

use App\Models\Language;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Country extends Model implements HasMedia , TranslatableContract
{
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;

    public $translatedAttributes = ['name'];

    protected $fillable = ['abbreviation','code','flag','status'];

    public function cities()
    {
        return $this->hasMany(City::class,'country_id','id');
    }
  
   
    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    
    

    
    

}