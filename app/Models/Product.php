<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'flavour_id',
        'slug',
        'stock',
        'featured',
        'halal'
    ];

    protected $appends = ['image'];

    /**
     * The ingredients that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    /**
     * The nutritions that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function stockDetails()
    {
        return $this->belongsToMany(Product::class, 'stock_details_pivot', 'product_id')
            ->withPivot('added_stock','old_stock', 'sold_stock')
            ->withTimestamps();
    }
    /**
     * The nutritions that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function nutritions()
    {
        return $this->belongsToMany(Nutrition::class)->withPivot('amount');
    }
    public function flavour()
    {
        return $this->belongsTo(Flavour::class);
    }
    /**
     * The users that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['day', 'key', 'plan_id', 'quantity'])
            ->withTimestamps();
    }



    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('slug', 'like', '%' . $search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->setPath('');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('image')
            ->singleFile();
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('image');
    }
    public function getIsStockAvailableAttribute()
    {
        if ($this->stock > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function gethaveStockWarningAttribute()
    {
        if ($this->stock < 5) {
            return true;
        } else {
            return false;
        }
    }
}
