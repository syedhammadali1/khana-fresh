<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachLanguagePivot extends Model
{
    use HasFactory;

    protected $fillable = ['coach_languages_id','coach_id'];
}
