<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Candidate extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'sa_id',
        'mobile_number',
        'date_of_birth',
        'language',
        'interests'
    ];
}
