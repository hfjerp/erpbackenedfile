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
        try {
            $Language = HfLanguage::create(['name'=>$request->name]);
            return response()->json($Language);
        } catch (\Throwable $th) {
            return response()->json(['msg'=>"Dublicate Entry"],500);
        }
        // return response();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfLanguage  $hfLanguage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $Language=HfLanguage::find($id);
       

        return response()->json($Language, 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfLanguage  $hfLanguage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // $role->update($request->all());
        // alert("reeeeee");
        $Language=HfLanguage::find($id);
        $Language->update([
            'name'=> $request->name,
        ]);
        // $role -> name=$request->input('name');
        // $role->update();
        return response()->json($request);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfLanguage  $hfLanguage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $role->delete();
        $res=HfLanguage::where('id',$id)->delete();
        return response()->json([$id]);
    }
}
