<?php

namespace App\Http\Controllers;

use App\Models\HfTaluk;
use Illuminate\Http\Request;

class HfTalukController extends Controller
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
        $taluk = HfTaluk::create(["name" => $request->name, "district_id" => $request->districtId]);

        return response()->json($taluk);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfTaluk  $taluk
     * @return \Illuminate\Http\Response
     */
    public function show(HfTaluk $taluk)
    {
        if ($taluk) {
            return response()->json($taluk);
        }
        return response()->json(['msg' => "No district is available"], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfTaluk  $taluk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfTaluk $taluk)
    {
        $taluk->update($request->all());

        return response()->json($taluk);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfTaluk  $taluk
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfTaluk $taluk)
    {
        $taluk->delete();

        return response()->json(['msg' => "Successfully Deleted"]);
    }
}
