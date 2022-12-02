<?php

namespace App\Http\Controllers;

use App\Models\Flavour;
use App\Http\Requests\StoreFlavourRequest;
use App\Http\Requests\UpdateFlavourRequest;
use Illuminate\Http\Request;

class FlavourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->keyword)) {
            $flavours = Flavour::search($request->keyword);
            $pagination = $flavours->appends(array(
                'keyword' => $request->keyword
            ));
        } else {
            $flavours = Flavour::orderBy('created_at', 'desc')->paginate(15);
        }




        return view('flavours.index', compact('flavours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flavours.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFlavourRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFlavourRequest $request)
    {
        Flavour::create($request->validated());
        return redirect()->route('flavours.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flavour  $flavour
     * @return \Illuminate\Http\Response
     */
    public function show(Flavour $flavour)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flavour  $flavour
     * @return \Illuminate\Http\Response
     */
    public function edit(Flavour $flavour)
    {
        return view('flavours.edit', compact('flavour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFlavourRequest  $request
     * @param  \App\Models\Flavour  $flavour
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFlavourRequest $request, Flavour $flavour)
    {
        $flavour->update($request->validated());
        return redirect()->route('flavours.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flavour  $flavour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flavour $flavour)
    {
        $flavour->delete();
        return redirect()->back();
    }
}
