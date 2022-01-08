<?php

namespace App\Http\Controllers;

use App\Models\HfDistrict;
use App\Models\HfTaluk;
use Illuminate\Http\Request;

class HfDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
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
        $district = HfDistrict::create(["name" => $request->name, "state_id" => $request->stateId]);

        return response()->json($district);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfDistrict  $district
     * @return \Illuminate\Http\Response
     */
    public function show(HfDistrict $district)
    {
        if($district){
            return response()->json($district);
        }
        return response()->json(['msg'=>"No district is available"], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfDistrict  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfDistrict $district)
    {
        $district->update($request->all());

        return response()->json($district);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfDistrict  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfDistrict $district)
    {
        $district->delete();

        return response()->json(['msg'=>"Successfully Deleted"]);
    }

    public function taluks($id)
    {
        $allTaluks = HfTaluk::where('district_id', $id)->get();
        if ($allTaluks) {
            return response()->json($allTaluks);
        }
        return response()->json(['msg' => "There is no entry of district for this state"], 500);
    }

    public function taluksall()
    {
        $allTaluks = HfTaluk::all();
        if ($allTaluks) {
            return response()->json($allTaluks);
        }
        return response()->json(['msg' => "There is no entry of district for this state"], 500);
    }

    public function filtertaluks()
    {
        $allTaluks = HfTaluk::all();
        if ($allTaluks) {
            return response()->json($allTaluks);
        }
        return response()->json(['msg' => "There is no entry of district for this state"], 500);
    }
}
