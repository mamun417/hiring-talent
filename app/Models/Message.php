<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(string[] $array)
 * @method static latest()
 */
class Message extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'subject', 'message'];


    const PERMISSION = [
        0 => 'show',
    ];

}
