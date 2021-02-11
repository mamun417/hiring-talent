<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @method static create(string[] $array)
 * @method static first()
 * @method static count()
 */
class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['address', 'phone_1', 'phone_2', 'telephone', 'email',
        'fax', 'updated_by'];


    const PERMISSION = [
        1 => 'create',
        2 => 'edit',
    ];


    public function updatedUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::updating(function ($setting){
            $setting->updated_by = Auth::id();
        });
    }
}
