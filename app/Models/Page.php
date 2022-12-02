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

class Page extends Model implements HasMedia
{
    use HasFactory;
    use Sluggable;
    use InteractsWithMedia;
    use SoftDeletes;
    use LanguageAttribute;

    protected $fillable = ['title', 'slug', 'content', 'data', 'status', 'template'];


    // protected $hidden = ['locale_parent', 'child_locale_parent'];

    protected $casts = [
        'data' => 'collection'
    ];
    protected $appends = ['languages', 'frontend_url'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }

    public function locale_parent()
    {
        return $this->hasMany(self::class, 'locale_parent_id');
    }

    public function child_locale_parent()
    {
        return $this->hasOne(self::class, 'id', 'locale_parent_id');
    }

    public function getFrontendUrlAttribute()
    {
        if ($this->locale_id) {
            $language =  $this->languages->where('locale_id', $this->locale_id)->first();
            if ($language) {
                return url('/') . '/' . $language->language->code . '/' . $this->slug;
            }
        }
        return url('/')  . '/' . $this->slug;
    }
}
