<?php

namespace App\Http\Controllers;

use App\Models\HfFamilyMemberAcademyMajor;
use Illuminate\Http\Request;

class HfFamilyMemberAcademyMajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $majorList = HfFamilyMemberAcademyMajor::all();

        return response()->json($majorList);
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
     * @param  \App\Models\HfFamilyMemberAcademyMajor  $hfFamilyMemberAcademyMajor
     * @return \Illuminate\Http\Response
     */
    public function show(HfFamilyMemberAcademyMajor $hfFamilyMemberAcademyMajor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfFamilyMemberAcademyMajor  $hfFamilyMemberAcademyMajor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfFamilyMemberAcademyMajor $hfFamilyMemberAcademyMajor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfFamilyMemberAcademyMajor  $hfFamilyMemberAcademyMajor
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfFamilyMemberAcademyMajor $hfFamilyMemberAcademyMajor)
    {
        //
    }
}
