<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderBg extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

}
