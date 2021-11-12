<?php

namespace App\Http\Controllers;

use App\Models\HfContactType;
use Illuminate\Http\Request;

class HfContactTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allContactTypes = HfContactType::all();
        return response()->json($allContactTypes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfContactType  $hfContactType
     * @return \Illuminate\Http\Response
     */
    public function show(HfContactType $hfContactType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfContactType  $hfContactType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfContactType $hfContactType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfContactType  $hfContactType
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfContactType $hfContactType)
    {
        //
    }
}
