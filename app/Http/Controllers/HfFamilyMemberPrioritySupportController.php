<?php

namespace App\Http\Controllers;

use App\Models\HfFamilyMemberPrioritySupport;
use Illuminate\Http\Request;

class HfFamilyMemberPrioritySupportController extends Controller
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
     * @param  \App\Models\HfFamilyMemberPrioritySupport  $hfFamilyMemberPrioritySupport
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hfFamilyMemberPrioritySupport=HfFamilyMemberPrioritySupport::find($id);
        
        $hfFamilyMemberPrioritySupport = HfFamilyMemberPrioritySupport::where('family_member_id', $id)->first();
       

        return response()->json($hfFamilyMemberPrioritySupport);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfFamilyMemberPrioritySupport  $hfFamilyMemberPrioritySupport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfFamilyMemberPrioritySupport $hfFamilyMemberPrioritySupport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfFamilyMemberPrioritySupport  $hfFamilyMemberPrioritySupport
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfFamilyMemberPrioritySupport $hfFamilyMemberPrioritySupport)
    {
        //
    }
}
