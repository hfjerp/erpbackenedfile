<?php

namespace App\Http\Controllers;

use App\Models\HfFamilyFood;
use Illuminate\Http\Request;

class HfFamilyFoodController extends Controller
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
     * @param  \App\Models\HfFamilyFood  $hfFamilyFood
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hfFamilyFood=HfFamilyFood::find($id);
        
        $hfFamilyFood = HfFamilyFood::where('family_id', $id)->first();
       

        return response()->json($hfFamilyFood);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfFamilyFood  $hfFamilyFood
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfFamilyFood $hfFamilyFood)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfFamilyFood  $hfFamilyFood
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfFamilyFood $hfFamilyFood)
    {
        //
    }
}
