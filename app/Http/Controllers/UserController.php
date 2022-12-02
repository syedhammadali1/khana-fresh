<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\Product;
use App\Models\User;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Excel;
use Illuminate\Support\Facades\DB;
use PDF;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->keyword)) {
            $users = User::search($request->keyword);
            $pagination = $users->appends(array(
                'keyword' => $request->keyword
            ));
        } else {
            $users = User::orderBy('created_at', 'desc')->paginate(10);
        }


        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        $user =  User::create($request->all());

        return redirect()->route('users.index')->with('class', 'success')->with('message', 'User add successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view('users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // if ($request->password) {

        //     $request->merge(['password' => Hash::make($request->password)]);
        //     $user->update($request->all());
        // } else {

        //     $user->update($request->except('password'));
        // }

        $user->update($request->all());

        return redirect()->route('users.index')->with('class', 'success')->with('message', 'User update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }


    public function exportIntoExcel()
    {
        return  Excel::download(new UserExport, 'userlist.xlsx');
    }

    public function generatePDF(Request $request)
    {
        if ($request->for == 'userplan') {
            $user_plan = UserPlan::find($request->id);
            $filename = $user_plan->user->email . '-' . $user_plan->id . '.pdf';
            $meals =  [];
            collect(DB::table('product_user')
                ->where('product_user.user_id', $user_plan->user->id)
                ->where('product_user.plan_id', $user_plan->plan->id)
                ->get(['product_id', 'quantity'])->toArray())->map(function ($meal) use (&$meals) {
                array_push($meals, ['name' => Product::find($meal->product_id)->name, 'quantity' => $meal->quantity]);
            });
            $user_plan = $user_plan->toArray();
            $user_plan += ['meals' => $meals];
            $data = [
                'user_plan' => $user_plan
            ];

            $pdf = PDF::loadView('pdf/order-detail', $data);
            return $pdf->download($filename);
        }
    }
}
