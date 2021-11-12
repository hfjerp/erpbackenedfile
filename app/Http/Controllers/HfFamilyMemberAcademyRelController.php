<?php

namespace App\Http\Controllers;

use App\Models\HfFamilyMemberRelMajor;
use Illuminate\Http\Request;

class HfFamilyMemberAcademyRelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $majorList = HfFamilyMemberRelMajor::all();

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
    public function show(HfFamilyMemberRelMajor $HfFamilyMemberRelMajor)
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
    public function update(Request $request, HfFamilyMemberRelMajor $HfFamilyMemberRelMajor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfFamilyMemberAcademyMajor  $hfFamilyMemberAcademyMajor
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfFamilyMemberRelMajor $HfFamilyMemberRelMajor)
    {
        //
    }
}
