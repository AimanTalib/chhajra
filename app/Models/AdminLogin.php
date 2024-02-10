<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminLogin extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_name',
        'email',
        'password',
    ];
}
