<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_id',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];


}