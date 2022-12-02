<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flavour extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

   public function scopeSearch($query,$search)
   {
       return $query->where('name','like','%'.$search.'%')
       ->orderBy('created_at','desc')
       ->paginate(10)
       ->setpath('');

   }
}
