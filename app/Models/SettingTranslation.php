<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name','address','description','words_guide','about','privacy','terms','why_hospital','path_to_success','sustainability' ,'hospital_policies' ,'management_team'];
}