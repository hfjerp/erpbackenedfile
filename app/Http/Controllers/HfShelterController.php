<?php

namespace App\Http\Controllers;

use App\Models\HfShelter;
use Illuminate\Http\Request;

class HfShelterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allShelters = HfShelter::all();

        return response()->json($allShelters, 200);
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
     * @param  \App\Models\HfShelter  $hfShelter
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hfShelter=HfShelter::find($id);
        
        $hfShelter = HfShelter::where('family_id', $id)->first();
       

        return response()->json($hfShelter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfShelter  $hfShelter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfShelter $hfShelter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfShelter  $hfShelter
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfShelter $hfShelter)
    {
        //
    }
}
