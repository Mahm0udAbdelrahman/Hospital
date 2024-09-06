<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class InfoHealth extends Model implements HasMedia , TranslatableContract
{
    
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;
    protected $fillable = ['image' ,'status'];
    public $translatedAttributes = ['name','description'];

}
