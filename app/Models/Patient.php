<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model  implements HasMedia 
{
    use HasFactory;
    use InteractsWithMedia; 

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date',
        'type',
        'country_id',
        'city_id',
        'image',
        'status'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }
 }
