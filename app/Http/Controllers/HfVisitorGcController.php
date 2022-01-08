<?php

namespace App\Http\Controllers;

use App\Models\HfVisitorGc;
use Illuminate\Http\Request;

class HfVisitorGcController extends Controller
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
        $Visitor = HfVisitorGc::create([
            
            
            'name'=>$request->name,
            'place'=>$request->place,
            'contact'=>$request->contactno,
            'p_of_visit'=>$request->p_of_visit,
            'type'=>$request->occupation,
            'course'=>$request->course,
            'c_name'=>$request->iname,

        
        
        
        ]);
        return response()->json($Visitor,200);
    // } catch (\Throwable $th) {
        return response()->json(['msg'=>"Dublicate Entry"],500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfVisitorGc  $HfVisitorGc
     * @return \Illuminate\Http\Response
     */
    public function show()

    {
    } 
    
    public function gcvisitorlist()

    {
        $visitor = HfVisitorGc::all();
       
            
       

        return response()->json($visitor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfVisitorGc  $HfVisitorGc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfVisitorGc $HfVisitorGc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfVisitorGc  $HfVisitorGc
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfVisitorGc $HfVisitorGc)
    {
        //
    }
}
