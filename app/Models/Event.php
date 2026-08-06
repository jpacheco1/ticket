<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
     protected $fillable = [
        'name',
        'place',
        'description',
        'start',
        'finish',
        'quota_by_district',
        'quota_additional',
        'quota_max',
        'district_id',
        'team_id',
        'user_id',
    ];
}
