<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $testimonials = new Testimonial();

        if ($request->locale_id) {
            $testimonials = $testimonials->where('locale_id', $request->locale_id);
        } else {
            $testimonials = $testimonials->where('locale_id', 1);
        }


        $testimonials = $testimonials->with('locale_parent')->latest()->get();
        return view('testimonials.index', [
            'testimonials' => $testimonials
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $coaches = Coach::has('user')->where('locale_id', ($request->locale_id ? $request->locale_id : 1))->get();
        $categories = [];

        return view('testimonials.create', [
            'testimonial ' => '',
            'coaches' => $coaches
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['locale_id' => ($request->locale_id) ? $request->locale_id : 1]);
        Testimonial::updateOrCreate(['id' => $request->page_id], $request->all());

        return redirect()->route('testimonials.index', ['locale_id' => $request->locale_id])->with('class', 'success')->with('message', 'Testimonial add successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        return view('testimonials.edit', ['blog' => $testimonial]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Testimonial $testimonial)
    {
        $coaches = Coach::has('user')->where('locale_id', ($request->locale_id ? $request->locale_id : 1))->get();

        return view('testimonials.edit', [
            'testimonial' => $testimonial,
            'coaches' => $coaches,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        //
    }
}
