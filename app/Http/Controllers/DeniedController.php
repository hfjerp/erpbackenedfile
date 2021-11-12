<?php

namespace App\Http\Controllers;

use App\Models\Denied;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DeniedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "Hello World!";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tempArr = [];
        foreach ($request->toArray() as $key => $value) {
            array_push($tempArr, $key);
        }

        for ($i=0; $i < count($tempArr)-1; $i++) {
            if($tempArr[$i]=='jamath_id'){
                continue;
            }
            Denied::create(['jamath_id'=>$request->jamath_id,'access_name'=>$tempArr[$i]]);
        }
        return response()->json(['msg'=>"Successfully Added New Entries"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Denied  $denied
     * @return \Illuminate\Http\Response
     */
    public function show(Denied $denied)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Denied  $denied
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Denied $denied)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Denied  $denied
     * @return \Illuminate\Http\Response
     */
    public function destroy(Denied $denied)
    {
        //
    }

    public function deniedAccess(Request $request)
    {
        $deniedList = Denied::where('jamath_id', $request->jamath_id)->get();
        if($deniedList){
            return response()->json($deniedList);
        }
        return response()->json(['msg'=>"There is no denied access"],500);
    }
}
