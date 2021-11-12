<?php

namespace App\Http\Controllers;

use App\Models\HfAddress;
use Illuminate\Http\Request;

class HfAddressController extends Controller
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfAddress  $hfAddress
     * @return \Illuminate\Http\Response
     */
    public function show(HfAddress $hfAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfAddress  $hfAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfAddress $hfAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfAddress  $hfAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfAddress $hfAddress)
    {
        //
    }
}
