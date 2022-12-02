<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $lang_menus = '';
        if ($request->menu) {
            $menu = Menus::find($request->menu);
            $lang_menus =  DB::table('admin_menus')->orwhere(function ($q) use ($menu) {
                if ($menu->locale_parent_id)
                    $q->where('id', $menu->locale_parent_id);
            })->orwhere(function ($q) use ($menu) {
                if ($menu->locale_parent_id !== null) {
                    $q->where('locale_parent_id', $menu->locale_parent_id);
                } else {
                    $q->where('locale_parent_id', $menu->id);
                }
            })->get();
        } elseif ($request->locale_parent_id) {
             $menu = Menus::find($request->locale_parent_id);
            if( $menu){
                $lang_menus =  DB::table('admin_menus')->orwhere(function ($q) use ($menu) {
                    if ($menu->locale_parent_id)
                        $q->where('id', $menu->locale_parent_id);
                })->orwhere(function ($q) use ($menu) {
                    if ($menu->locale_parent_id !== null) {
                        $q->where('locale_parent_id', $menu->locale_parent_id);
                    } else {
                        $q->where('locale_parent_id', $menu->id);
                    }
                })->get();
            }

        }

        return view('menu.create');
    }

    public function menuLocale(Request $request)
    {
        $lang_menus = '';
        $menu = Menus::find($request->menu);

        if ($menu) {
            return redirect()->route('menus.index', [
                'menu' => $request->menu,
                'locale_parent_id' => $menu->locale_parent_id,
                'locale_id' => $menu->locale_id
            ]);
        } else {
            return redirect()->route('menus.index', [
                'menu' => $request->menu,
                'action' => $request->action
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = new Menus();
        $menu->name = request()->input("menuname");
        $menu->locale_id = request()->input("locale_id");
        $menu->locale_parent_id = request()->input("locale_parent_id");
        $menu->save();
        return json_encode(array("resp" => $menu->id, "locale_parent_id" => $menu->locale_parent_id, "locale_id" => $menu->locale_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
