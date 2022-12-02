<?php

namespace App\Http\Controllers;

use App\Models\Nutrition;
use App\Http\Requests\StoreNutritionRequest;
use App\Http\Requests\UpdateNutritionRequest;
use Illuminate\Http\Request;

class NutritionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->keyword)) {
            $nutritions = Nutrition::search($request->keyword);
            $pagination = $nutritions->appends(array(
                'keyword' => $request->keyword
            ));
        } else {
            $nutritions = Nutrition::orderBy('created_at', 'desc')->paginate(10);
        }


        return view('nutritions.index', compact('nutritions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nutritions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNutritionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNutritionRequest $request)
    {
        Nutrition::create($request->validated());
        return redirect()->route('nutritions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nutrition  $nutrition
     * @return \Illuminate\Http\Response
     */
    public function show(Nutrition $nutrition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nutrition  $nutrition
     * @return \Illuminate\Http\Response
     */
    public function edit(Nutrition $nutrition)
    {
        return view('nutritions.edit', compact('nutrition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNutritionRequest  $request
     * @param  \App\Models\Nutrition  $nutrition
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNutritionRequest $request, Nutrition $nutrition)
    {
        $nutrition->update($request->validated());
        return redirect()->route('nutritions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nutrition  $nutrition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nutrition $nutrition)
    {
        if (!$nutrition->products()->exists()) {
            $nutrition->delete();
            return redirect()->back()->with(['success' => 'Nutrition deleted successfully!']);
        } else {
            return redirect()->back()->with(['error' => $nutrition->products()->count() . ' products are using ' . $nutrition->name . ', You Cannot Delete It.']);
        }
    }
}
