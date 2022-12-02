<?php

namespace App\Http\Traits;

/*
|--------------------------------------------------------------------------
| Api Responser Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
*/

trait StatusScope
{
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInActive($query)
    {
        return $query->where('status', 'inactive');
    }

}
