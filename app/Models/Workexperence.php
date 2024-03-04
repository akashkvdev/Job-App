<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workexperence extends Model
{
    use HasFactory;

    protected $primaryKey = 'work_exp_id';
    protected $fillable = ['user_id','company_name','job_title','start_date','end_date','responsibilities','skills_accquired'];
}
