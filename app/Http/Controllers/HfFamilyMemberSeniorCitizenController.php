<?php

namespace App\Http\Controllers;

use App\Models\HfFamilyMemberSeniorCitizen;
use Illuminate\Http\Request;

class HfFamilyMemberSeniorCitizenController extends Controller
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
     * @param  \App\Models\HfFamilyMemberSeniorCitizen  $hfFamilyMemberSeniorCitizen
     * @return \Illuminate\Http\Response
     */
    public function show2($id)
    {
        $hfFamilyMemberSeniorCitizen=HfFamilyMemberSeniorCitizen::find($id);
        
        $hfFamilyMemberSeniorCitizen = HfFamilyMemberSeniorCitizen::where('family_member_id', $id)->first();
        $hfFamilyMemberSeniorCitizen['senior_citizen_card_img_url'] = url($hfFamilyMemberSeniorCitizen->senior_citizen_card_img_url);

       

        return response()->json($hfFamilyMemberSeniorCitizen);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfFamilyMemberSeniorCitizen  $hfFamilyMemberSeniorCitizen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfFamilyMemberSeniorCitizen $hfFamilyMemberSeniorCitizen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfFamilyMemberSeniorCitizen  $hfFamilyMemberSeniorCitizen
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfFamilyMemberSeniorCitizen $hfFamilyMemberSeniorCitizen)
    {
        //
    }
}
