<?php

namespace App\Http\Livewire\Component\Frontend\Menu\User;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductEdit extends Component
{
    public $plan, $products;
    public $userlimit, $productsQuantity = [], $total;

    public function mount()
    {
        $this->userlimit = $this->plan->limit;
        $this->products = Product::all();
        $this->total = $this->userlimit;
    }

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
                        if (!Product::find($id)->is_stock_available) {
                            return $this->dispatchBrowserEvent('showNotifications', [
                                'message' => 'Sorry this product is out of stock',
                            ]);
                        }
                        $this->productsQuantity[$id] = 1;
                        $this->total = array_sum($this->productsQuantity);
                        $this->disabled = true;

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
    public function plus($id)
    {
        try {
            if ($this->total < $this->userlimit) {
                $this->productsQuantity[$id]++;
                $this->total = array_sum($this->productsQuantity);
                $this->disabled = true;
            } else {
                $this->disabled = false;
                $this->dispatchBrowserEvent('showNotifications', [
                    'message' => 'You cannot select more than ' . $this->userlimit . ' items',
                ]);
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
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('showNotifications', [
                'message' => $e->getMessage(),
            ]);
        }


    }
    public function appyProduct()
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
        $oldProducts = [];
        $a = DB::table('product_user')
            ->where('user_id', auth()->id())
            ->where('plan_id', $this->plan->id);

        $a->get(['product_id', 'quantity'])->map(function ($item) use (&$oldProducts) {
            $oldProducts += [
                $item->product_id =>
                $item->quantity,
            ];
        })->toArray();

        $arraysAreEqual = ($oldProducts == $this->productsQuantity);
        if (!$arraysAreEqual) {
            $a->delete();
            foreach ($this->productsQuantity as $key => $value) {
                ProductService::stockProduct($key, $value);
                $productsAmountArray = [
                    $key => [
                        'quantity' => $value,
                        'plan_id' =>  $this->plan->id
                    ]
                ];
                auth()->user()->meals()->attach($productsAmountArray);
            }
            return redirect()
                ->route('frontend.plan.details', ['plan' => $this->plan->name, 'user' => auth()->user()->email])
                ->with(['success' => 'Your menu has been updated successfully!']);
        } else {
            return $this->dispatchBrowserEvent('toast', [
                'message' => 'Please change your menu!',
                'type' => 'warning',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.component.frontend.menu.user.product-edit');
    }
}
