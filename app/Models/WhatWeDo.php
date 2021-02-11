<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static latest()
 * @method static first()
 */
class WhatWeDo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sub_title',
        'description',
        'youtube_link_1',
        'youtube_link_2',
    ];

    const PERMISSION = [
        1 => 'create',
        2 => 'edit',
        3 => 'delete',
    ];

}
