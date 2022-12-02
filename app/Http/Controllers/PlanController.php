<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\UserPlan;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    protected $stripe;

    // public function __construct()
    // {
    //     $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->keyword)) {
            $plans = Plan::search($request->keyword);
            $pagination = $plans->appends(array(
                'keyword' => $request->keyword
            ));
        } else {
            $plans = Plan::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlanRequest $request)
    {
        $plan = $request->validated();
        // $stripeProduct = $this->stripe->products->create([
        //     'name' => $plan['name'],
        // ]);
        // $stripePlanCreation = $this->stripe->plans->create([
        //     'amount' => $plan['price'] * $plan['limit'] * 100,
        //     'currency' => 'inr',
        //     'interval' => 'month',
        //     'product' => $stripeProduct->id,
        // ]);
        // $plan += [
        //     'stripe_plan' => $stripePlanCreation->id
        // ];
        Plan::create($plan);
        return redirect()->route('plans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        $paymentMethods = auth()->user()->paymentMethods();

        $intent = auth()->user()->createSetupIntent();

        return view('plans.show', compact('plan', 'intent'));
        // return view('plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlanRequest  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlanRequest $request, Plan $plan)
    {
        $plan->update($request->validated());
        return redirect()->route('plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        if (!$plan->users()->exists()) {
            $plan->delete();
            return redirect()->back();
        } else {
            return redirect()->back()->with(['error' => 'Plan ' . $plan->name . ' Has ' . $plan->users()->count() . ' Users, You Cannot Delete It.']);
        }
    }
}
