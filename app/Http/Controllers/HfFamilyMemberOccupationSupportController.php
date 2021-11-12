<?php

namespace App\Http\Controllers;

use App\Models\HfFamilyMemberOccupationSupport;
use Illuminate\Http\Request;

class HfFamilyMemberOccupationSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfFamilyMemberOccupationSupport  $hfFamilyMemberOccupationSupport
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $HfFamilyMemberOccupationSupport=HfFamilyMemberOccupationSupport::find($id);
        
        $HfFamilyMemberOccupationSupport = HfFamilyMemberOccupationSupport::where('family_member_id', $id)->first();
       

        return response()->json($HfFamilyMemberOccupationSupport);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfFamilyMemberOccupationSupport  $hfFamilyMemberOccupationSupport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfFamilyMemberOccupationSupport $hfFamilyMemberOccupationSupport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfFamilyMemberOccupationSupport  $hfFamilyMemberOccupationSupport
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfFamilyMemberOccupationSupport $hfFamilyMemberOccupationSupport)
    {
        //
    }
}
