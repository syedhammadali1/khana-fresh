<?php
namespace App\Http\Traits;
use Illuminate\Support\Str;
trait DateFormat
{

    public function getCreatedAtFormattedAttribute(){
        return [
            $this->created_at->toDayDateTimeString(),
        ];
    }

}

