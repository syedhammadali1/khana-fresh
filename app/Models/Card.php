<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'holder_name',
        'card_number',
        'cvc',
        'expiry_date',
    ];

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->expiry_date)->format('m/y');
    }
    public function getCardHiddenNumberAttribute()
    {
        $showValue = 5;
        $notHidden = substr($this->card_number, 0, $showValue);
        $count = strlen($this->card_number) - $showValue;
        $star = '';
        for ($i = 0; $i < $count; $i++) {
            $star .=  '*';
        }

        return $notHidden . $star;
    }
}
