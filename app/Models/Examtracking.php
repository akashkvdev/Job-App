<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examtracking extends Model
{
    use HasFactory;
    protected $primaryKey = 'exam_track_id';

    protected $fillable = ['user_id','exam_id','question_id','user_answer','qualified_status'];
}
