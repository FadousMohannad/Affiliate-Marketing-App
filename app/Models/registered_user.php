<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registered_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'user_id',
    ];
}
