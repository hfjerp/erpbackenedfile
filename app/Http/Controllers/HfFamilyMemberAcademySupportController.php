<?php

namespace App\Http\Controllers;

use App\Models\HfFamilyMemberAcademySupport;
use Illuminate\Http\Request;

class HfFamilyMemberAcademySupportController extends Controller
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
     * @param  \App\Models\HfFamilyMemberAcademySupport  $hfFamilyMemberAcademySupport
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hfFamilyMemberAcademySupport=HfFamilyMemberAcademySupport::find($id);
        
        $hfFamilyMemberAcademySupport = HfFamilyMemberAcademySupport::where('family_member_id', $id)->first();
       

        return response()->json($hfFamilyMemberAcademySupport);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfFamilyMemberAcademySupport  $hfFamilyMemberAcademySupport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfFamilyMemberAcademySupport $hfFamilyMemberAcademySupport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfFamilyMemberAcademySupport  $hfFamilyMemberAcademySupport
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfFamilyMemberAcademySupport $hfFamilyMemberAcademySupport)
    {
        //
    }
}
