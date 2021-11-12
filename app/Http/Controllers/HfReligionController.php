<?php

namespace App\Http\Controllers;

use App\Models\HfReligion;
use Illuminate\Http\Request;

class HfReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allReligions = HfReligion::all();

        return response()->json($allReligions, 200);
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
     * @param  \App\Models\HfReligion  $hfReligion
     * @return \Illuminate\Http\Response
     */
    public function show(HfReligion $hfReligion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfReligion  $hfReligion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfReligion $hfReligion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfReligion  $hfReligion
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfReligion $hfReligion)
    {
        //
    }
}
