<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coupen_id',
        'price',
        'plan_id',
        'status',
        'week1',
        'week2',
        'week3',
        'week4',
        'anet_subscription_id',
        'expire_at',
        'created_at'
    ];

    protected $dates = [
        'expire_at',
        'week1',
        'week2',
        'week3',
        'week4',
    ];

    /**
     * Get the plan that owns the UserPlan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Get the user that owns the UserPlan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matchWeek($from, $to)
    {
        $array = [];
        $week1 = $this->week1->toDateString();
        if ($week1 >= $from && $week1 <= $to) {
            $array += ['Week 1' => $this->week1->format('l, d F y')];
        }
        $week2 = $this->week2->toDateString();
        if ($week2 >= $from && $week2 <= $to) {
            $array += ['Week 2' => $this->week2->format('l, d F y')];
        }
        $week3 = $this->week3->toDateString();
        if ($week3 >= $from && $week3 <= $to) {
            $array += ['Week 3' => $this->week3->format('l, d F y')];
        }
        $week4 = $this->week4->toDateString();
        if ($week4 >= $from && $week4 <= $to) {
            $array += ['Week 4' => $this->week4->format('l, d F y')];
        }
        return $array;
    }

    public function whichWeekArePassed()
    {
        $occurrences = 0;
        if (!$this->week1->isPast()) {
            $occurrences++;
        }
        if (!$this->week2->isPast()) {
            $occurrences++;
        }
        if (!$this->week3->isPast()) {
            $occurrences++;
        }
        if (!$this->week4->isPast()) {
            $occurrences++;
        }
        return $occurrences;
    }

    public function weekToBePaid()
    {
        if (!$this->week1->isPast()) {
            return [
                'name' => 'week 1',
                'canSendMail' => check96HoursLeft($this->week1->format('Y-m-d'))
            ];
        }
        if (!$this->week2->isPast()) {
            return [
                'name' => 'week 2',
                'canSendMail' => check96HoursLeft($this->week2->format('Y-m-d'))
            ];
        }
        if (!$this->week3->isPast()) {
            return [
                'name' => 'week 3',
                'canSendMail' => check96HoursLeft($this->week3->format('Y-m-d'))
            ];
        }
        if (!$this->week4->isPast()) {
            return [
                'name' => 'week 4',
                'canSendMail' => check96HoursLeft($this->week4->format('Y-m-d'))
            ];
        }
    }
}
