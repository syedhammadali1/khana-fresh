<?php

namespace App\Models;

use App\Http\Traits\LanguageAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Coach extends Model
{
    use HasFactory;
    use LanguageAttribute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'designation',
        'specialization',
        'website_url',
        'mobile_no',
        'content',
        'status',
        'country_id',
        'state_id',
        'city_id',
        'first_name',
        'last_name',
        'locale_id',
        'locale_parent_id'
    ];

    protected $appends = ['full_name', 'languages'];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    /**
     * Get the user that owns the Coach
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The coach_languages that belong to the Coach
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function coach_languages(): BelongsToMany
    {
        return $this->belongsToMany(CoachLanguage::class, 'coach_language_pivots', 'coach_id', 'coach_languages_id');
    }

    /**
     * Get all of the coach_qualification for the Coach
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coach_qualification(): HasMany
    {
        return $this->hasMany(CoachQualification::class);
    }

    /**
     * Get the country associated with the Coach
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the state associated with the Coach
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the city associated with the Coach
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }


}
