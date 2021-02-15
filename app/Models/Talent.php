<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail(int $int)
 */
class Talent extends Model
{

    protected $fillable = [
        'user_id',
        'talent_name',
        'parent_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'eye_color',
        'hair_color',
        'height',
        'weight',
        'shirt_size',
        'pant_size',
        'shoe_size',
        'ethnicity_one',
        'ethnicity_two',
        'mail_address',
        'subject',
        'referred_by',
        'message',
        'la_casting_profile_link',
        'actor_access_profile_link',
        'website',
        'imdb_page',
        'represent_agency',
    ];

    use HasFactory;

    const PERMISSION = [
        0 => 'show',
        1 => 'send message',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function refererBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies(){
        return $this->hasMany(TalentReply::Class);
    }

}
