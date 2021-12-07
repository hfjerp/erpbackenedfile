<?php

namespace App\Http\Controllers;

use App\Models\HfFamilyMemberLabour;
use Illuminate\Http\Request;

class HfFamilyMemberLabourController extends Controller
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
     * @param  \App\Models\HfFamilyMemberLabour  $hfFamilyMemberLabour
     * @return \Illuminate\Http\Response
     */
    public function show2($id)
    {
        $hfFamilyMemberLabour=HfFamilyMemberLabour::find($id);
        
        $hfFamilyMemberLabour = HfFamilyMemberLabour::where('family_member_id', $id)->first();
        $hfFamilyMemberLabour['labour_card_img_url'] = url($hfFamilyMemberLabour->labour_card_img_url);

       

        return response()->json($hfFamilyMemberLabour);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfFamilyMemberLabour  $hfFamilyMemberLabour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfFamilyMemberLabour $hfFamilyMemberLabour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfFamilyMemberLabour  $hfFamilyMemberLabour
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfFamilyMemberLabour $hfFamilyMemberLabour)
    {
        //
    }
}
