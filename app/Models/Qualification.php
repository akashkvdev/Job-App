<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;
    protected $primaryKey = 'ed_qual_id';

    protected $fillable = ['user_id','degree_name','field_of_study','university','passout_year','grade'];
}
