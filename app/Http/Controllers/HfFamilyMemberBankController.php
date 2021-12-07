<?php

namespace App\Http\Controllers;

use App\Models\HfFamilyMemberBank;
use Illuminate\Http\Request;

class HfFamilyMemberBankController extends Controller
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
    public function show2($id)
    {
        $hfFamilyMemberBank=HfFamilyMemberBank::find($id);
        
        $hfFamilyMemberBank = HfFamilyMemberBank::where('family_member_id', $id)->first();
        $hfFamilyMemberBank['passbook_url'] = url($hfFamilyMemberBank->passbook_url);

       

        return response()->json($hfFamilyMemberBank);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfFamilyMemberBank  $hfFamilyMemberBank
     * @return \Illuminate\Http\Response
     */
    public function show(HfFamilyMemberBank $hfFamilyMemberBank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfFamilyMemberBank  $hfFamilyMemberBank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfFamilyMemberBank $hfFamilyMemberBank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfFamilyMemberBank  $hfFamilyMemberBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfFamilyMemberBank $hfFamilyMemberBank)
    {
        //
    }
}
