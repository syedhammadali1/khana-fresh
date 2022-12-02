<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class UserExport implements FromCollection,WithHeadings,WithChunkReading
{

    public function chunkSize(): int
    {
        return 400;
    }

    public function headings():array
    {
       return[
        'First_name',
        'Last_name',
        'Email',
        'Status',
        'City',
        'State',
        'Phone',
        'Address',
        'Address2',
        'Zip',
        'Plans',
        'PlanPrice',
        'PlanExpireAt',
       ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = User::with('plan')->get();
        $usersArray = [];
        collect($users)->map(function ($item) use (&$usersArray) {
            $planArray = "";
            $planPrice = "";
            $planExpireAt = "";
            if ($item->plan->isNotEmpty()) {
                $activePlan = $item->plan()->where('status', 2)->first();
                if (!is_null($activePlan)) {
                    $planArray = $activePlan->plan->name;
                    $planPrice = $activePlan->plan->price;
                    $planExpireAt = $activePlan->expire_at;
                } else {
                    $planArray = "No Active Plan";
                    $planPrice = "-";
                    $planExpireAt = "-";
                }
            } else {
                $planArray = "No Plan Selected";
                $planPrice = "-";
                $planExpireAt = "-";
            }
            $usersArray += [$item->id => [
                'first_name' => $item->first_name,
                'last_name' => $item->last_name,
                'email' => $item->email,
                'status' => $item->status,
                'city' => $item->city,
                'state' => $item->state,
                'phone' => $item->phone,
                'address' => $item->address,
                'address2' => $item->address2,
                'zip' => $item->zip,
                'plans' => $planArray,
                'planprice' => $planPrice,
                'PlanExpireAt' => $planExpireAt,
            ]];
        });
        return collect($usersArray);

    }
}
