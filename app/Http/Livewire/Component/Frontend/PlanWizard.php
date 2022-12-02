<?php

namespace App\Http\Livewire\Component\Frontend;

use App\Mail\AdminNewOrderNotify;
use App\Mail\ClientNewOrderNotify;
use App\Models\Card;
use App\Models\Copen;
use App\Models\Options;
use App\Models\Plan;
use App\Models\Product;
use App\Models\User;
use App\Models\UserPlan;
use App\Models\Zip;
use App\Services\ProductService;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;


class PlanWizard extends Component
{
    public $plans, $products, $userPlanArray;
    public $week1, $week2, $week3, $week4, $showWeeks = false;
    public $userplan, $userlimit, $productsQuantity = [], $total, $selectedPlan, $userCoupen;
    public $selectedProducts = [], $productsDays = [], $days = [];
    public $step = 1, $count = 4, $disabled = true, $fromday;
    public $fname, $lname, $address1, $address2, $phone, $city, $state, $zip, $coupen, $discountApplied = false, $discount, $totalPrice, $pricePerWeek;
    public $holder_name, $cvc, $card_number, $expiry_date, $authUserPlan;
    public $week1min, $week2min, $week2max, $week3min, $week3max, $week4min, $week4max, $lastplan, $taxRate, $taxRateAmount;
    public $intent, $usersubscription, $success = false;
    public $disabled_dates, $disabled_dates_array;

    protected $listeners = [
        'selectproduct' => 'selectProduct',
        'updatingWeek1' => 'updatingWeek1'
    ];

    protected $validationAttributes = [
        'week1' => 'week 1',
        'week2' => 'week 2',
        'week3' => 'week 3',
        'week4' => 'week 4'
    ];

    // constructor hai yeh
    public function mount()
    {
        try {
            //code...

            // user ki info
            $user = auth()->user();
            $this->zip = $user->zip;
            $this->fname = $user->first_name;
            $this->lname = $user->last_name;
            $this->city = $user->city;
            $this->state = $user->state;
            $this->address1 = $user->address;
            $this->address2 = $user->address2;
            $this->phone = $user->phone;
            $this->plans = Plan::orderBy('limit', 'asc')->get();
            $this->products = Product::all();
            // user ky plan exist kerta hai ky nai
            $this->userPlanArray = $user->plan->pluck('status', 'plan_id')->toArray();
            $this->authUserPlan = $user->plan->isNotEmpty();

            // ager user ky pass phalay plan hai tou vo ek month add ker dyga verna 2 din ky baad select ker sktay hou
            if ($this->authUserPlan) {
                $this->lastplan = CarbonImmutable::parse(auth()->user()->plan->last()->expire_at);
                $this->fromday = $this->lastplan->format('F');
                $this->week1min =  $this->lastplan->format('Y-m-d');
            } else {
                $this->week1min = Carbon::parse(now())->addDays(3)->format('Y,m,d');
                // $this->week1min = CarbonImmutable::parse('12-MAY-22')->format('Y-m-d');
            }
            $this->disabled_dates = Options::where('key', 'restricted_delivery_dates')->first()->value;
            $this->disabled_dates_array =  convertStringToArray($this->disabled_dates);

            // if (auth()->user()->status == 0) {
            //     $this->step = -1;
            // }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('showNotifications', [
                'message' => $e->getMessage(),
            ]);
        }
    }

    // select product in plan page
    public function selectProduct($id)
    {
        try {
            if (array_key_exists($id, $this->productsQuantity)) {
                $a = $this->productsQuantity[$id];
                $this->total -= $a;
                unset($this->productsQuantity[$id]);
                $this->disabled = true;
            } else {

                if (!is_null($this->total)) {
                    if ($this->total < $this->userlimit) {
                        $this->productsQuantity[$id] = 1;
                        $this->total = array_sum($this->productsQuantity);
                        $this->disabled = true;
                        if ($this->total == $this->userlimit) {
                            $this->disabled = false;
                        }
                    } else {
                        $this->disabled = false;
                        $this->dispatchBrowserEvent('showNotifications', [
                            'message' => 'You cannot select more than ' . $this->userlimit . ' items',
                        ]);
                    }
                } else {
                    $this->productsQuantity[$id] = 1;
                    $this->total += array_sum($this->productsQuantity);
                }
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('showNotifications', [
                'message' => $e->getMessage(),
            ]);
        }
    }
    // it will plus 1 in the count of plan products
    public function plus($id)
    {
        try {
            $p = Product::find($id);
            if ($this->productsQuantity[$id] >= $p->stock) {
                $amount = $this->productsQuantity[$id] + 1;
                $ordinals = $amount == 2 ? 'nd' : ($amount == 3 ? 'rd' : 'th');
                $msg = $amount . $ordinals . ' quantity is unavailable for this item.';
                throw new \Exception($msg);
            }
            if ($this->total < $this->userlimit) {
                $this->productsQuantity[$id]++;
                $this->total = array_sum($this->productsQuantity);
                $this->disabled = true;
            } else {
                $this->dispatchBrowserEvent('showNotifications', [
                    'message' => 'You cannot select more than ' . $this->userlimit . ' items',
                ]);
            }
            if ($this->total == $this->userlimit) {
                $this->disabled = false;
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('showNotifications', [
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function minus($id)
    {
        try {
            if ($this->productsQuantity[$id] == 1) {
                $a = $this->productsQuantity[$id];
                $this->total -= $a;
                unset($this->productsQuantity[$id]);
            } else {
                $this->productsQuantity[$id]--;
                $this->total = array_sum($this->productsQuantity);
            }
            if ($this->total == $this->userlimit) {
                $this->disabled = false;
            } else {
                $this->disabled = true;
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('showNotifications', [
                'message' => $e->getMessage(),
            ]);
        }
    }
    // it will check coupen and apply it
    public function coupenCheck()
    {
        $this->validate(
            [
                'coupen' => [
                    'required', function ($attribute, $value, $fail) {
                        $coupen = Copen::where('name', $this->coupen)->first();
                        if (is_null($coupen)) {
                            $fail('Sorry! This Coupen Doesn\'t exist');
                        } elseif ($coupen->active == 0) {
                            $fail('Sorry! This Coupen is Expired');
                        }
                    }
                ]
            ]
        );


        try {
            //code...
            $this->userCoupen = Copen::where('name', $this->coupen)->first();
            $this->discount = $this->userCoupen->discount;
            $this->pricePerWeek = $this->selectedPlan->price * $this->userlimit;
            $this->pricePerWeek = $this->pricePerWeek - ($this->pricePerWeek * ($this->discount / 100));
            $this->taxRateAmount = $this->pricePerWeek * $this->taxRate / 100;
            $this->pricePerWeek = $this->pricePerWeek + $this->taxRateAmount;
            $this->totalPrice = $this->pricePerWeek + $this->taxRateAmount;
            $this->discountApplied = true;
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('showNotifications', [
                'message' => $e->getMessage(),
            ]);
        }
    }





    // it will check week1 day and update another weeks according to week1
    public function updatingWeek1($date)
    {
        $this->week1 = $date;
        $this->validate(
            [
                'week1' => [
                    function ($attribute, $value, $fail) use ($date) {
                        $val = CarbonImmutable::parse($date);

                        if ($val->isSunday()) {
                            $fail('We deliver on Tuesday to Saturday');
                        } elseif ($val->isMonday()) {
                            $fail('We deliver on Tuesday to Saturday');
                        }
                    }
                ]
            ],
        );
        try {
            //code...
            $val = CarbonImmutable::parse($date);
            $this->week2 = $val->addWeek()->toDateString();
            $this->week2min = $val->addWeek()->startOfWeek()->toDateString();
            $this->week2max = $val->addWeek()->endOfWeek()->toDateString();

            $this->week3 = $val->addWeek(2)->toDateString();
            $this->week3min = $val->addWeek(2)->startOfWeek()->toDateString();
            $this->week3max = $val->addWeek(2)->endOfWeek()->toDateString();

            $this->week4 = $val->addWeek(3)->toDateString();
            $this->week4min = $val->addWeek(3)->startOfWeek()->toDateString();
            $this->week4max = $val->addWeek(3)->endOfWeek()->toDateString();

            $this->showWeeks = true;
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('showNotifications', [
                'message' => $e->getMessage(),
            ]);
        }
    }




    // it will check and validate zip code and apply tax according to it
    public function updatingZip($value)
    {
        try {
            //code...
            $zip = Zip::where('name', $value)->first();
            if (!is_null($zip)) {
                $this->pricePerWeek = $this->selectedPlan->price * $this->userlimit;
                $this->taxRate = $zip->tax_rate;
                $this->taxRateAmount = $this->pricePerWeek * $this->taxRate / 100;
                $this->pricePerWeek = $this->pricePerWeek + $this->taxRateAmount;
                $this->totalPrice = $this->pricePerWeek + $this->taxRateAmount;
                if ($this->discountApplied) {
                    $this->pricePerWeek = $this->pricePerWeek - ($this->pricePerWeek * ($this->discount / 100));
                }
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('showNotifications', [
                'message' => $e->getMessage(),
            ]);
        }
    }
    // it will check  step one and than move forward
    public function stepOne()
    {
        $this->validate(
            [
                'userplan' => [
                    'required', function ($attribute, $value, $fail) {
                        if (array_key_exists($value, $this->userPlanArray)) {
                            $fail('You have already selected this plan.');
                        } elseif (in_array(1, $this->userPlanArray)) {
                            $fail('You already have a pending plan.');
                        } elseif (in_array(2, $this->userPlanArray)) {
                            $fail('You are already using a plan, cancel it to create another one.');
                        }
                    }
                ]
            ],
            [
                'userplan.required' => 'Please select your plan first!'
            ]
        );


        try {
            //code...
            $this->selectedPlan = Plan::find($this->userplan);
            $this->userlimit = $this->selectedPlan->limit;
            $this->totalPrice = ($this->selectedPlan->price * $this->userlimit) * 4;
            $this->step = 2;
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('showNotifications', [
                'message' => $e->getMessage(),
            ]);
        }
    }
    // it will check product quantity and than move forward
    public function stepTwo()
    {
        $this->validate(
            [
                'productsQuantity' => [
                    'required', 'array', function ($attribute, $value, $fail) {
                        if ($this->total != $this->userlimit) {
                            $fail('Products must have at least ' . $this->userlimit . ' items.');
                        }
                    }
                ]
            ],
            [
                'productsQuantity.required' => 'Please select product',
            ]
        );

        try {
            //code...

            $this->step = 3;
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('showNotifications', [
                'message' => $e->getMessage(),
            ]);
        }
    }
    // it will check and validate weeksDate and show tax amount according to zipcode
    public function stepThree()
    {
        $this->validate(
            [
                'week1' => [
                    'required', 'after_or_equal:week1min',
                    function ($attribute, $value, $fail) {
                        $val = CarbonImmutable::parse($value);
                        // dd($val);
                        if ($val->isSunday()) {
                            $fail('We deliver on Tuesday to Saturday');
                        } elseif ($val->isMonday()) {
                            $fail('We deliver on Tuesday to Saturday');
                        }
                    }
                ],
                'week2' => [
                    'required', 'after_or_equal:week2min', 'before_or_equal:week2max',
                    function ($attribute, $value, $fail) {
                        $val = CarbonImmutable::parse($value);
                        if ($val->isSunday()) {
                            $fail('We deliver on Tuesday to Saturday');
                        } elseif ($val->isMonday()) {
                            $fail('We deliver on Tuesday to Saturday');
                        }elseif(in_array($val->format('d-m-Y'), $this->disabled_dates_array)){
                            $fail('Sorry! We cannot deliver on '.$val->format('l, d-F-Y').'.');
                        }
                    }
                ],
                'week3' => [
                    'required', 'after_or_equal:week3min', 'before_or_equal:week3max',
                    function ($attribute, $value, $fail) {
                        $val = CarbonImmutable::parse($value);
                        if ($val->isSunday()) {
                            $fail('We deliver on Tuesday to Saturday');
                        } elseif ($val->isMonday()) {
                            $fail('We deliver on Tuesday to Saturday');
                        }elseif(in_array($val->format('d-m-Y'), $this->disabled_dates_array)){
                            $fail('Sorry! We cannot deliver on '.$val->format('l, d-F-Y').'.');
                        }
                    }
                ],
                'week4' => [
                    'required', 'after_or_equal:week4min', 'before_or_equal:week4max',
                    function ($attribute, $value, $fail) {
                        $val = CarbonImmutable::parse($value);
                        if ($val->isSunday()) {
                            $fail('We deliver on Tuesday to Saturday');
                        } elseif ($val->isMonday()) {
                            $fail('We deliver on Tuesday to Saturday');
                        }elseif(in_array($val->format('d-m-Y'), $this->disabled_dates_array)){
                            $fail('Sorry! We cannot deliver on '.$val->format('l, d-F-Y').'.');
                        }
                    }
                ],
            ],
        );


        try {
            //code...
            $this->pricePerWeek = $this->selectedPlan->price * $this->userlimit;
            $this->step = 4;
            if (!is_null($this->zip)) {
                $zip = Zip::where('name', $this->zip)->first();
                if (!is_null($zip)) {
                    $this->taxRate = $zip->tax_rate;
                    $this->taxRateAmount = $this->pricePerWeek * $this->taxRate / 100;
                    $this->pricePerWeek = $this->pricePerWeek + $this->taxRateAmount;
                }
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('showNotifications', [
                'message' => $e->getMessage(),
            ]);
        }
    }
    // it will validate user info with zip code and auto fill card info if card info exist
    public function stepFour()
    {

        $this->validate(
            [
                'fname' => 'required',
                'lname' => 'required',
                'address1' => 'required',
                'city' => 'required',
                'state' => 'required',
                'phone' => 'required',
                'zip' => [
                    'required', function ($attribute, $value, $fail) {
                        if (is_null(Zip::where('name', $this->zip)->first())) {
                            $fail('Sorry! We dont deliver here.');
                        }
                    }
                ],
                'address2' => 'nullable',
            ],
            [
                'fname.required' => 'The first name field is required.',
                'lname.required' => 'The last name field is required.',
                'address1.required' => 'The address field is required.'
            ]
        );

        try {
            //code...
            if (!is_null(auth()->user()->card)) {
                $card = auth()->user()->card;
                $this->holder_name = $card->holder_name;
                $this->cvc = $card->cvc;
                $this->card_number = $card->card_number;
                $this->expiry_date = $card->expiry_date;
            }
            $this->step = 5;
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('showNotifications', [
                'message' => $e->getMessage(),
            ]);
        }
    }
    // it will validate card info and create subcription in authorize.net
    public function stepFive()
    {
        $this->validate(
            [
                'holder_name' => 'required',
                'cvc' => 'required|numeric',
                'card_number' => 'required|numeric|min:1',
                'expiry_date' => 'required',
            ]
        );

        try {
            $response = DB::transaction(function () {
                $userplan = UserPlan::create([
                    'user_id' => auth()->id(),
                    'plan_id' => $this->userplan,
                    'price' => $this->pricePerWeek, // with coupen price
                    'week1' => $this->week1,
                    'week2' => $this->week2,
                    'week3' => $this->week3,
                    'week4' => $this->week4,
                    'status' => 2,
                    'expire_at' => Carbon::now()->addMonth()
                ]);

                if ($this->discountApplied) {
                    $userplan->update([
                        'coupen_id' => $this->userCoupen->id
                    ]);
                }
                if ($this->authUserPlan) {
                    $userplan->update(
                        [
                            'status' => 1,
                            'created_at' => $this->lastplan,
                            'expire_at' => $this->lastplan->addMonth()
                        ]
                    );
                }

                foreach ($this->productsQuantity as $key => $value) {
                    (new ProductService)->stockProduct($key, $value);
                    $productsAmountArray = [
                        $key => [
                            'quantity' => $value,
                            'plan_id' => $this->userplan
                        ]
                    ];
                    auth()->user()->meals()->attach($productsAmountArray);
                }
                User::find(auth()->id())->update([
                    'first_name' => $this->fname,
                    'last_name' => $this->lname,
                    'city' => $this->city,
                    'state' => $this->state,
                    'address' => $this->address1,
                    'address2' => $this->address2,
                    'phone' => $this->phone,
                    'zip' => $this->zip,
                ]);
                Card::updateOrCreate(
                    ['user_id' => auth()->id()],
                    [
                        'user_id' => auth()->id(),
                        'holder_name' => $this->holder_name,
                        'card_number' => $this->card_number,
                        // 'cvc' => $this->cvc,
                        'expiry_date' => $this->expiry_date,
                    ]
                );
                $this->usersubscription = $userplan->id;

                $array = [
                    'card' => [
                        'holder_name' => $this->holder_name,
                        // 'cvc' => $this->cvc,
                        'card_number' => $this->card_number,
                        'expiry_date' => $this->expiry_date,
                    ],
                    'plan' => [
                        'name' => $this->selectedPlan->name,
                        'price' =>  number_format((float) $this->totalPrice, 2, '.', ''),
                        'length' => 7,
                        'unit' => 'days',
                        'occurrences' => '9999',
                        'order_id' => $userplan->id,
                        'start_date' => Carbon::parse($userplan->created_at)->addDay(),
                    ],
                    'user' => [
                        'email' => auth()->user()->email,
                        'first_name' => $this->fname,
                        'last_name' => $this->lname,
                        'city' => $this->city,
                        'state' => $this->state,
                        'address' => $this->address1,
                        'address2' => $this->address2,
                        'phone' => $this->phone,
                        'zip' => $this->zip,
                    ],
                ];
                if ($this->discountApplied) {
                    $array += [
                        'coupen' => [
                            'trialprice' => number_format((float) $this->pricePerWeek, 2, '.', ''),
                            'trialoccurrences' => 4 * 3, //week * month
                        ]
                    ];
                }

                // for checking if user has previous plan or not
                if ($this->authUserPlan) {
                    // $array += [
                    //     'anet' => [
                    //         'anet_profile_id' => auth()->user()->anet_profile_id,
                    //         'anet_payment_id' => auth()->user()->anet_payment_id
                    //     ]
                    // ];
                    // $response = createANETSubscriptionFromCustomerProfile($array);
                    // UserPlan::find($this->usersubscription)->update([
                    //     'anet_subscription_id' => $response->getSubscriptionId()
                    // ]);
                } else {
                    $response = createANETSubscription($array);
                    auth()->user()->update([
                        'anet_profile_id' => $response->getProfile()->getCustomerProfileId(),
                        'anet_payment_id' => $response->getProfile()->getCustomerPaymentProfileId()
                    ]);
                    UserPlan::find($this->usersubscription)->update([
                        'anet_subscription_id' => $response->getSubscriptionId()
                    ]);
                    $array += [
                        'anet' => [
                            'anet_profile_id' => $response->getProfile()->getCustomerProfileId(),
                            'anet_payment_id' => $response->getProfile()->getCustomerPaymentProfileId()
                        ]
                    ];
                }
            });
            // $array = [
            //     'user' => [
            //         'email' => auth()->user()->email,
            //     ],
            //     'anet' => [
            //         'anet_profile_id' => auth()->user()->anet_profile_id,
            //     ]
            // ];
            // updateANETCustomerInfo($array);
            $adminMail = [
                'title' => 'new order created',
                'body' =>  auth()->user()->email . ' has selected ' . $this->selectedPlan->name . ' plan',
            ];
            $clientMail = [
                'title' => 'new order created',
                'body' =>   'Thank you for ordering' . $this->selectedPlan->name . ' plan',
            ];

            Mail::to('hammadali407292@gmail.com')->send(new AdminNewOrderNotify($adminMail));
            Mail::to('hammadali407292@gmail.com')->send(new ClientNewOrderNotify($clientMail));
            // Mail::to(getAdminEmail())->send(new ProductOutOfStock($product));


            $this->step = 6;

            // $this->success = true;
        } catch (\Exception $e) {
            $this->addError('paymentError', preg_replace('/"/', '', $e->getMessage()));
        }

        // if ($this->success) {
        // }
    }
    public function render()
    {
        return view('livewire.component.frontend.plan-wizard');
    }
}


        //     // dd(
        //     //     $response,
        //     //     $response->getrefId(),
        //     //     $response->getProfile(),
        //     //     $response->getProfile()->getCustomerProfileId(),
        //     //     $response->getProfile()->getCustomerPaymentProfileId(),
        //     //     $response->getSubscriptionId()
        //     // );

        // foreach ($this->productsQuantity as $key => $value) {
        //     $productsAmountArray += [$key => ['quantity' => $this->productsQuantity[$key]]];
        // }
        // if ($this->discountApplied) {
        //     UserPlan::create([
        //         'user_id' => auth()->id(),
        //         'plan_id' => $this->userplan,
        //         'price' => $this->totalPrice,
        //         'expire_at' => Carbon::now()->addMonth(),
        //         'coupen_id' => $this->userCoupen->id
        //     ]);
        // } else {
        //     UserPlan::create([
        //         'user_id' => auth()->id(),
        //         'plan_id' => $this->userplan,
        //         'price' => $this->totalPrice,
        //         'expire_at' => Carbon::now()->addMonth()
        //     ]);
        // }
        // dd($this->productsQuantity);

          // if (in_array(1, $this->userPlanArray) || in_array(2, $this->userPlanArray)) {
        //     $userplan->update([
        //         'status' => 1,
        //         'created_at' => Carbon::now()->addMonth(),
        //         'expire_at' => Carbon::now()->addMonth(2)
        //     ]);
        // } else {
        //     $plan = auth()->user()->plan->pluck('expire_at')->last();

        // }

         // $productsAmountArray = [];
        // foreach ($this->productsDays as $key => $value) {
        //     $pid = array_keys($value);
        //     $productsAmountArray = [
        //         $pid[0]  => [
        //             'day' => $value[$pid[0]],
        //             'key' => $key,
        //             'plan_id' => $this->userplan
        //         ]
        //     ];
        //     auth()->user()->meals()->attach($productsAmountArray);
        // }
