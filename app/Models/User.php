<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'status',
        'zip',
        'address',
        'address2',
        'city',
        'state',
        'status',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
        'anet_profile_id',
        'anet_payment_id',
        'password',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get the coach associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function coach(): HasOne
    {
        return $this->hasOne(Coach::class);
    }

    /**
     * The products that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function meals()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['day', 'key', 'plan_id', 'quantity'])
            ->withTimestamps();
    }


    /**
     * Get the card associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function card()
    {
        return $this->hasOne(Card::class);
    }


    /**
     * Get all of the plan for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plan()
    {
        return $this->hasMany(UserPlan::class);
    }
    public function plans()
    {
        return $this->hasManyThrough(
            Plan::class,
            UserPlan::class,
            'user_id', // Foreign key on the ConstructionProduct table...
            'id', // Foreign key on the ConstructionStoreProduct table...
            'id', // Local key on the projects table...
            'plan_id' // Local key on the environments table...
        );
    }


    public function scopeSearch($query, $search)
    {
        return $query->where('email', 'like', '%' . $search . '%')
            ->orWhere('first_name', 'like', '%' . $search . '%')
            ->orWhere('last_name', 'like', '%' . $search . '%')
            ->orWhere('zip', 'like', '%' . $search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->setPath('');
    }


    public function getUser()
    {
        // $user= User::with('plan')->select('id','first_name','last_name','email','status','city','state','phone','address','address2','zip')->get()->toArray();
        // $plan = $user->plans->pluck('id');
        // collect($item->plan)->map(function ($item) use (&$planArray, &$planPrice) {
        //     if ($item->status == 2) {
        //         $planArray = $item->plan->name;
        //         $planPrice = $item->plan->price;
        //         // 'status' => config('enum.plan_status')[$item->status],
        //     } else {
        //         $planArray = "No Active Plan";
        //     }
        // });

    }
}
