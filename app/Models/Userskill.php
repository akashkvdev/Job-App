<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userskill extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_skill_id';
    protected $fillable = ['user_id','user_skills1','user_skills2','user_skills3','user_skills4','user_skills5'];
}
