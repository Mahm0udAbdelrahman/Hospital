<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalTourism extends Model  implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'type',
        'country_id',
        'date',
        'medical_report',
        'case_details',
        'status',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
