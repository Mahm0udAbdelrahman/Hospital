<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Competency extends Model  implements  TranslatableContract
{
    use HasFactory;

    use Translatable;
    protected $fillable = ['image', 'status'];
    public $translatedAttributes = ['name', 'description'];

    protected function getImageAttribute($value)
    {
        if ($value) {
            return asset('media/Competency' . '/' . $value);
        } else {
            return asset('media/Competency/default.png');
        }
    }

    public function setImageAttribute($value)
    {
        if ($value) {
            // حذف الصورة القديمة إذا كانت موجودة
            if (!empty($this->attributes['image'])) {
                @unlink(public_path('media/Competency/' . $this->attributes['image']));
            }

            // حفظ الصورة الجديدة
            $imageName = time() . '.' . $value->getClientOriginalExtension();
            $value->move(public_path('media/Competency/'), $imageName);
            $this->attributes['image'] = $imageName;
        }
    }

}
