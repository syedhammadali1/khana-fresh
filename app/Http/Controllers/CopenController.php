<?php

namespace App\Http\Controllers;

use App\Models\Copen;
use App\Http\Requests\StoreCopenRequest;
use App\Http\Requests\UpdateCopenRequest;
use Illuminate\Http\Request;

class CopenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->keyword)) {
            $copens = Copen::search($request->keyword);
            $pagination = $copens->appends(array(
                'keyword' => $request->keyword
            ));
        } else {
            $copens = Copen::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('copens.index', compact('copens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('copens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCopenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCopenRequest $request)
    {
        // dd($request->validated());
        Copen::create($request->validated());
        return redirect()->route('copens.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Copen  $copen
     * @return \Illuminate\Http\Response
     */
    public function show(Copen $copen)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Copen  $copen
     * @return \Illuminate\Http\Response
     */
    public function edit(Copen $copen)
    {
        return view('copens.edit', compact('copen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCopenRequest  $request
     * @param  \App\Models\Copen  $copen
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCopenRequest $request, Copen $copen)
    {
        $copen->update($request->validated());
        return redirect()->route('copens.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Copen  $copen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Copen $copen)
    {
        $copen->delete();
        return redirect()->back();
    }
}
