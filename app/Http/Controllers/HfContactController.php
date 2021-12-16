<?php

namespace App\Http\Controllers;

use App\Models\HfContact;
use Illuminate\Http\Request;
use DB;

class HfContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
     * @param  \App\Models\HfContact  $hfContact
     * @return \Illuminate\Http\Response
     */
    public function show(HfContact $hfContact,$id)
    {

        $address= DB::table('hf_families')
        ->join('hf_family_contacts','hf_family_contacts.family_id','hf_families.id')
        ->join('hf_contacts','hf_contacts.id','hf_family_contacts.contact_id')
       
        ->where('hf_families.id','=',$id)
        ->get();
        
        return response()->json($address, 200);
    }
    
    public function show2($id)
    {

        $address= DB::table('hf_family_members')
        ->join('hf_family_member_contacts','hf_family_member_contacts.family_member_id','hf_family_members.id')
        ->join('hf_contacts','hf_contacts.id','hf_family_member_contacts.contact_id')
       
        ->where('hf_family_members.id','=',$id)
        ->get();
        
        return response()->json($address, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfContact  $hfContact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfContact $hfContact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfContact  $hfContact
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfContact $hfContact)
    {
        //
    }
}
