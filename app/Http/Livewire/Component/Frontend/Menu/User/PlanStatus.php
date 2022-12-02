<?php

namespace App\Http\Livewire\Component\Frontend\Menu\User;

use App\Models\UserPlan;
use App\Models\Zip;
use Carbon\Carbon;
use Livewire\Component;

class PlanStatus extends Component
{
    public $item, $planArray, $success = false;
    public function mount($item)
    {
        $this->item = $item;
        $this->planArray = auth()->user()->plan()->pluck('status')->toArray();
    }

    public function renew()
    {
        if (in_array(1, $this->planArray)) {
            $plan = auth()->user()->plan()->where('status', 1)->first()->plan;
            $this->dispatchBrowserEvent('toast', [
                'message' => 'You already have ' . $plan->name . ' plan in pending, Please cancel it first!',
                'type' => 'warning',
            ]);
        } elseif (in_array(2, $this->planArray)) {
            $plan = auth()->user()->plan()->where('status', 2)->first()->plan;
            $this->dispatchBrowserEvent('toast', [
                'message' => 'You are already using ' . $plan->name . ' plan, Please cancel it first!',
                'type' => 'danger',
            ]);
        } elseif ($this->item->status == 0) {
            // for price calculation
            // $pricePerWeek = $this->item->price;
            // $taxRate = Zip::where('name', auth()->user()->zip)->first()->tax_rate;
            // $taxRateAmount = $pricePerWeek * $taxRate / 100;
            // $pricePerWeek = $pricePerWeek + $taxRateAmount;
            // // for price calculation
            // $array = [
            //     'plan' => [
            //         'name' => $this->item->plan->name,
            //         'price' =>  number_format((float) $pricePerWeek, 2, '.', ''),
            //         'length' => 7,
            //         'unit' => 'days',
            //         'occurrences' => '9999',
            //         'order_id' => $this->item->id,
            //         'start_date' => Carbon::parse($this->item->created_at)->addDay(),
            //     ],
            //     'anet' => [
            //         'anet_profile_id' => auth()->user()->anet_profile_id,
            //         'anet_payment_id' => auth()->user()->anet_payment_id
            //     ]
            // ];

            // $response = createANETSubscriptionFromCustomerProfile($array);
            // UserPlan::find($this->item->id)->update([
            //     'status' => 1,
            //     'anet_subscription_id' => $response->getSubscriptionId()
            // ]);
            UserPlan::find($this->item->id)->update([
                'status' => 1,
            ]);
            return redirect()->route('frontend.dashboard')->with('success', 'Your plan ' . $this->item->name . ' will continue after ' . Carbon::parse($this->item->created_at)->addDay()->format('d-m-Y'));
        } elseif ($this->item->status == 3) {
            // for price calculation
            $occurrences = 9999;
            $array = [
                'plan' => [
                    'occurrences' =>  $occurrences
                ],
                'subscription' => [
                    'anet_id' => $this->item->anet_subscription_id
                ],
            ];

            $response = updateEndDateANETSubscription($array);

            UserPlan::find($this->item->id)->update([
                'status' => 2,
            ]);
            return redirect()->route('frontend.dashboard');
            // ->with('success', 'Your plan ' . $this->item->name . ' will continue after ' . Carbon::parse($this->item->created_at)->addDay()->format('d-m-Y'))
        }
    }
    public function cancel()
    {
        // check if status is active
        try {
            if ($this->item->status == 2) {
                $response = getANETSubscription($this->item->anet_subscription_id);
                $transactions = $response->getSubscription()->getArbTransactions();
                $transactionsCount = $transactions != null ? count($response->getSubscription()->getArbTransactions()) : 0;
                // check which week are left
                $occurrences = $this->item->whichWeekArePassed() + $transactionsCount;

                $array = [
                    'plan' => [
                        'occurrences' =>  $occurrences
                    ],
                    'subscription' => [
                        'anet_id' => $this->item->anet_subscription_id
                    ],
                ];
                if (!is_null($this->item->coupen_id)) {
                    $array += [
                        'coupen' => [
                            'trialprice' => 0.00,
                            'trialoccurrences' => 0,
                        ]
                    ];
                }
                //for updating anet sub and setting array fields
                updateEndDateANETSubscription($array);

                UserPlan::find($this->item->id)->update([
                    'status' => 3
                ]);

                return redirect()->route('frontend.plan')->with('success ', 'Your plan ' . $this->item->name . ' will continue after ' . Carbon::parse($this->item->created_at)->addDay()->format('d-m-Y'));
            }
            if ($this->item->status == 1) {
                // cancelANETSubscription($this->item->anet_subscription_id);
                UserPlan::find($this->item->id)->update([
                    'status' => 0
                ]);
                return redirect()->route('frontend.plan')->with('success ', 'Your plan ' . $this->item->name . ' will continue after ' . Carbon::parse($this->item->created_at)->addDay()->format('d-m-Y'));
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('showNotifications', [
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.component.frontend.menu.user.plan-status');
    }
}
