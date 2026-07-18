<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $fillable = [
        'event_id',
        'district_id',
        'nid',
        'name',
        'cellphone',
        'email',
        'team_id',
        'user_id',
        'address',
        'city',
        'attached',
        'additional'
    ];
}
