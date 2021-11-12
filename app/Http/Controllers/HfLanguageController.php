<?php

namespace App\Http\Controllers;

use App\Models\HfLanguage;
use Illuminate\Http\Request;

class HfLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allHfLanguages = HfLanguage::all();

        return response()->json($allHfLanguages, 200);
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
     * @param  \App\Models\HfLanguage  $hfLanguage
     * @return \Illuminate\Http\Response
     */
    public function show(HfLanguage $hfLanguage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfLanguage  $hfLanguage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfLanguage $hfLanguage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfLanguage  $hfLanguage
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfLanguage $hfLanguage)
    {
        //
    }
}
