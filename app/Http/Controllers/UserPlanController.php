<?php

namespace App\Http\Controllers;

use App\Models\UserPlan;
use App\Http\Requests\StoreUserPlanRequest;
use App\Http\Requests\UpdateUserPlanRequest;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;

class UserPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $word =  $request->keyword;
        if (isset($word)) {
            $userplans = UserPlan::whereHas('plan', function ($q) use ($word) {
                $q->where('name', 'like', '%' . $word . '%');
            })->paginate(15);
        } else {
            $userplans = UserPlan::orderBy('created_at', 'desc')->paginate(15);
        }
        return view('user-plans.index', compact('userplans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user-plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserPlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPlanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPlan  $userPlan
     * @return \Illuminate\Http\Response
     */
    public function show(UserPlan $userplan)
    {

        $planMeals = User::find($userplan->user_id)->meals()->wherePivot('plan_id', $userplan->plan_id)->get();
        return view('user-plans.show', compact('userplan', 'planMeals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPlan  $userPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPlan $userPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserPlanRequest  $request
     * @param  \App\Models\UserPlan  $userPlan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPlanRequest $request, UserPlan $userPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPlan  $userPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPlan $userPlan)
    {
        //
    }

    public function ajax(Request $request)
    {
        dd($request->all());
    }

    public function zipUserPlan(Request $request)
    {
        $userplans = UserPlan::with('user')->whereHas('user', function ($query) use ($request) {
            $query->where('zip', $request->code);
        })->paginate(15);
        return view('user-plans.index', compact('userplans'));
    }
}
