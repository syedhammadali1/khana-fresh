<?php
namespace App\Http\Traits;
use Illuminate\Support\Str;
trait Uuids
{
   /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
            //$model->country_id = 231;
        });
    }


 

}
