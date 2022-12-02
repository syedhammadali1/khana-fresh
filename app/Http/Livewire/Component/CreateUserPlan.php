<?php

namespace App\Http\Livewire\Component;

use App\Models\Plan;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CreateUserPlan extends Component
{
    use WithPagination;

    public $users, $plans, $plan = "", $producttoggle = false, $limit, $products, $checked = [], $quantity = [];
    public function mount()
    {
        $this->users = User::all();
        $this->plans = Plan::all();
    }
    public function checkPlan()
    {
        if ($this->plan != "") {
            $this->producttoggle = true;
            $this->limit = Plan::find($this->plan)->limit;
            $this->products = Product::all();
        } else {
            $this->producttoggle = false;
        }
    }
    public function checkproduct($id)
    {
        if (in_array($id, $this->checked)) {
            $key = array_search($id, $this->checked);
            unset($this->checked[$key]);
        } else {
            array_push($this->checked, $id);
        }

        // if (($key = array_search($id, $this->check)) !== false) {
        //     dd('if');
        //     // unset($check[$key]);
        //     // unset($qqty[$key]);
        //     // unset($proprice[$key]);
        // } else {
        //     dd('else');
        //     // $this->addproducts = array_push($check, $product->id);
        //     // $this->quantity = array_push($qqty, $this->qty);
        //     // $price = $product->price * $this->qty;
        //     // $this->proprice = array_push($proprice, $price);
        //     // $this->qty = null;
        // }
    }
    public function render()
    {
        return view('livewire.component.create-user-plan',);
    }
}
