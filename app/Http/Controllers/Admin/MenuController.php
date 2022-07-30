<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Yajra\DataTables\DataTables;
use App\Http\Requests\MenuRequest;
use App\Services\MenuServices;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Menu::all())
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.menu');
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
     * @param  \App\Http\Requests\MenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request,MenuServices $MenuServices)
    {
        $MenuServices->handle($request);
        return response()->json(["status"=>"success","message"=>"Menu Created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return response()->json(["status" => "success", "data" => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MenuRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request,MenuServices $MenuServices)
    {
        $MenuServices->handle($request);
        return response()->json(["status"=>"success","message"=>"Menu Updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return response()->json(["status"=>"success","message"=>"Menu Deleted"]);
    }
}
