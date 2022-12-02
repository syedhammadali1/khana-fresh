<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\UserPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userPlans = UserPlan::all();
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalActiveOrder = $userPlans->where('status', 1)->count();
        $totalIncome = 0;
        collect($userPlans)->map(function ($item) use (&$totalIncome) {

            $totalIncome += $item->price;
        });
        $dates = getDeliveryDate();
        $from = $dates['from'];
        $to = $dates['to'];
        $todayDelivery = UserPlan::where('status', '=', 2)
            ->where(function ($query) use ($from, $to) {
                $query->orWhereBetween('week1', [$from, $to])
                    ->orWhereBetween('week2', [$from, $to])
                    ->orWhereBetween('week3', [$from, $to])
                    ->orWhereBetween('week4', [$from, $to]);
            })->count();
        $productStockLeft = Product::where('stock', '<=', '5')->orderBy('stock', 'asc')->get();
        return view('index', compact('totalActiveOrder', 'totalIncome', 'totalUsers', 'totalProducts', 'todayDelivery', 'productStockLeft'));
    }
}
