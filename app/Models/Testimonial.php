<?php

namespace App\Models;

use App\Http\Traits\LanguageAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Testimonial extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LanguageAttribute;

    protected $fillable = ['content', 'user_id', 'coach_id'];

    protected $appends = ['languages'];

    protected $hidden = ['locale_parent', 'child_locale_parent'];

    public function locale_parent()
    {
        return $this->hasMany(self::class, 'locale_parent_id');
    }

    public function child_locale_parent()
    {
        return $this->hasOne(self::class, 'id', 'locale_parent_id');
    }

}
