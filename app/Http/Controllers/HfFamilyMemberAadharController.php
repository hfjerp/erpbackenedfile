<?php

namespace App\Http\Controllers;

use App\Models\HfFamilyMemberAadhar;
use Illuminate\Http\Request;

class HfFamilyMemberAadharController extends Controller
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
     * @param  \App\Models\HfFamilyMemberAadhar  $hfFamilyMemberAadhar
     * @return \Illuminate\Http\Response
     */
    public function show2($id)
    {
        $hfFamilyMemberAadhar=HfFamilyMemberAadhar::find($id);
        
        $hfFamilyMemberAadhar = HfFamilyMemberAadhar::where('family_member_id', $id)->first();
        $hfFamilyMemberAadhar['aadhar_card_img_url'] = url($hfFamilyMemberAadhar->aadhar_card_img_url);
       

        return response()->json($hfFamilyMemberAadhar);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfFamilyMemberAadhar  $hfFamilyMemberAadhar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfFamilyMemberAadhar $hfFamilyMemberAadhar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfFamilyMemberAadhar  $hfFamilyMemberAadhar
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfFamilyMemberAadhar $hfFamilyMemberAadhar)
    {
        //
    }
}
