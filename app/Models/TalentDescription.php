<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static count()
 * @method static first()
 * @method static create(array $only)
 */
class TalentDescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
    ];

    const PERMISSION = [
        1 => 'create',
        2 => 'edit',
    ];

}
