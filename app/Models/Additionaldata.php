<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additionaldata extends Model
{
    use HasFactory;

    protected $primaryKey = 'additional_id';
    protected $fillable = ['user_id','certification','language_spoken','hobbies','reverence','cover_letter'];
}
