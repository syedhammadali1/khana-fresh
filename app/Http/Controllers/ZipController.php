<?php

namespace App\Http\Controllers;

use App\Exports\ZipExport;
use App\Models\Zip;
use App\Http\Requests\StoreZipRequest;
use App\Http\Requests\UpdateZipRequest;
use App\Imports\ZipImport;
use App\Rules\ExcelRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ZipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if (isset($request->keyword)) {
            $zips = Zip::search($request->keyword);
            $pagination = $zips->appends(array(
                'keyword' => $request->keyword
            ));
        } else {
            $zips = Zip::orderBy('created_at', 'desc')->paginate(10);
        }


        return view('zips.index', compact('zips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zips.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreZipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreZipRequest $request)
    {

        Zip::create($request->validated());
        return redirect()->route('zips.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zip  $zip
     * @return \Illuminate\Http\Response
     */
    public function show(Zip $zip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zip  $zip
     * @return \Illuminate\Http\Response
     */
    public function edit(Zip $zip)
    {
        return view('zips.edit', compact('zip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateZipRequest  $request
     * @param  \App\Models\Zip  $zip
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateZipRequest $request, Zip $zip)
    {
        //
        $zip->update($request->validated());
        return redirect()->route('zips.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zip  $zip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zip $zip)
    {
        $zip->delete();
        return redirect()->back();
    }

    public function importCreate()
    {
        return view('zips.import');
    }
    public function import(Request $request)
    {
        if (!isset($request->file)) {
            $request->validate([
                'file' => ['required'],
            ]);
        }
        $request->validate([
            'file' => [new ExcelRule($request->file('file'))],
        ]);

        Excel::import(new ZipImport,$request->file('file'));

        return redirect()->route('zips.index')->with('success', 'Zips Imported');
    }

    public function export()
    {
        // dd('hello');
       return Excel::download(new ZipExport, 'ziplist.xlsx');
    }
}
