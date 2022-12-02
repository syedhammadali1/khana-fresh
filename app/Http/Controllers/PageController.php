<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pages\StorePageRequest;
use App\Models\CoachLanguagePivot;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('permission:pages.list', ['only' => ['index']]);
    //     $this->middleware('permission:pages.create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:pages.edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:pages.delete', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pages = new Page;

        // if ($request->locale_id) {
        //     $pages = $pages->where('locale_id', $request->locale_id);
        // } else {
        //     $pages = $pages->where('locale_id', 1);
        // }


        $pages = $pages->latest()->get();
        return view('pages.index', [
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create', ['page' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        // $request->merge(['locale_id' => ($request->locale_id) ? $request->locale_id : 1]);
        Page::updateOrCreate(['id' => $request->page_id], $request->all());
        return redirect()->route('pages.index')->with('class', 'success')->with('message', 'Page add successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('pages.edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }

    public function template(Request $request)
    {   
        return view('pages.templates.' . $request->template)->with('page', null)->render();
    }
}
