<?php

namespace App\Http\Controllers;

use App\Models\HfDistrict;
use App\Models\HfState;
use Illuminate\Http\Request;

class HfStateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allStates = HfState::all();

        return response()->json($allStates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try {
            $state = HfState::create(['name'=>$request->name]);
            return response()->json($state);
        // } catch (\Throwable $th) {
        //     return response()->json(['msg'=>"Dublicate Entry"],500);
        // }
        // return response();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfState  $state
     * @return \Illuminate\Http\Response
     */
    public function show(HfState $state)
    {
        return response()->json($state);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfState  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfState $state)
    {
        $state->update($request->all());

        return response()->json($state);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfState  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfState $state)
    {
        $state->delete();
        return response()->json(['msg'=>"Successfully Deleted"]);
    }
    public function districts($id)
    {
        $allDistricts = HfDistrict::where('state_id', $id)->get();
        if ($allDistricts) {
            return response()->json($allDistricts);
        }
        return response()->json(['msg' => "There is no entry of district for this state"], 500);
    }
}
