<?php

namespace App\Models;

use App\Http\Traits\LanguageAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;
    use LanguageAttribute;

    protected $fillable = ['question','answer', 'status'];

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
