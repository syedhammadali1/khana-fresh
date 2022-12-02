<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zip extends Model
{
    use HasFactory;
    protected $guarded = [''];

   public function getUserPlanAttribute(){


    return UserPlan::with('user')->whereHas('user', function ($query){
        $query->where('zip', $this->name);
    })->count();

   }



    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('zip_name', 'like', '%' . $search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->setPath('');
    }


}
