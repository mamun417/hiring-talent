<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method static count()
 */
class FeaturedBrand extends Model
{
    protected $fillable = [
        'name',
        'title'
    ];

    const PERMISSION = [
        1 => 'create',
        2 => 'edit',
        3 => 'delete',
    ];

    use HasFactory;

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

}
