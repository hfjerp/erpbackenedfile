<?php

namespace App\Http\Controllers;

use App\Models\HfFamilyMemberHealth;
use Illuminate\Http\Request;

class HfFamilyMemberHealthController extends Controller
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
     * @param  \App\Models\HfFamilyMemberHealth  $hfFamilyMemberHealth
     * @return \Illuminate\Http\Response
     */
    public function show2($id)
    {
        $hfFamilyMemberHealth=HfFamilyMemberHealth::find($id);
        
        $hfFamilyMemberHealth = HfFamilyMemberHealth::where('family_member_id', $id)->first();
        $hfFamilyMemberHealth['health_card_img_url'] = url($hfFamilyMemberHealth->health_card_img_url);

       

        return response()->json($hfFamilyMemberHealth);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfFamilyMemberHealth  $hfFamilyMemberHealth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfFamilyMemberHealth $hfFamilyMemberHealth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfFamilyMemberHealth  $hfFamilyMemberHealth
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfFamilyMemberHealth $hfFamilyMemberHealth)
    {
        //
    }
}
