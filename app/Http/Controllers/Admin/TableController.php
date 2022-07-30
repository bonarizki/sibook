<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Http\Requests\TableRequest;
use Yajra\DataTables\DataTables;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Table::all())
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.table');
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
     * @param  \App\Http\Requests\TableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TableRequest $request)
    {
        Table::create($request->all());
        return response()->json(["status" => "success", "message" => "Table Added"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        return response()->json(["status" => "success", "data" => $table]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TableRequest  $request
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(TableRequest $request, Table $table)
    {
        $table->update($request->except('_token'));
        return response()->json(["status" => "success", "message" => "Table Updated"]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        $table->delete();
        return response()->json(["status" => "success", "message" => "Table Deleted"]);
    }
}
