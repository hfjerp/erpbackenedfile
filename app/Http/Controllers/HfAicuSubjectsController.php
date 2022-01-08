<?php

namespace App\Http\Controllers;

use App\Models\HfAicuSubject;
use Illuminate\Http\Request;

class HfAicuSubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allHfAicuSubjects = HfAicuSubject::all();

        return response()->json($allHfAicuSubjects, 200);
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
            $AicuSubjects = HfAicuSubject::create(['name'=>$request->name]);
            return response()->json($AicuSubjects);
        // } catch (\Throwable $th) {
            return response()->json(['msg'=>"Dublicate Entry"],500);
        // }
        // return response();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfAicuSubject  $HfAicuSubject
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $AicuSubjects=HfAicuSubject::find($id);
       

        return response()->json($AicuSubjects, 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfAicuSubject  $HfAicuSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // $role->update($request->all());
        // alert("reeeeee");
        $AicuSubjects=HfAicuSubject::find($id);
        $AicuSubjects->update([
            'name'=> $request->name,
        ]);
        // $role -> name=$request->input('name');
        // $role->update();
        return response()->json($request);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfAicuSubject  $HfAicuSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $role->delete();
        $res=HfAicuSubject::where('asub_id',$id)->delete();
        return response()->json([$id]);
    }
}
