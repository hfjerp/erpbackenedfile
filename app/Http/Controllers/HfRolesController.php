<?php

namespace App\Http\Controllers;

use App\Models\HfRole;
use Illuminate\Http\Request;

class HfRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if($user->role->id == '1'){
            $hfRoles = HfRole::all();
            return response()->json($hfRoles);
        }else{
            $hfRoles = HfRole::where('parent_id',$user->role->id)->get();
            if($hfRoles){
                return response()->json($hfRoles);
            }
            return response()->json(['msg'=>"No Role Assign Access"]);

        }
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
            $role = HfRole::create(['name'=>$request->name]);
            return response()->json($role);
        // } catch (\Throwable $th) {
        //     return response()->json(['msg'=>"Dublicate Entry"],500);
        // }
        // return response();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfRole  $hfRole
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $role=HfRole::find($id);
       

        return response()->json($role, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfRole  $hfRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // $role->update($request->all());
        // alert("reeeeee");
        $role=HfRole::find($id);
        $role->update([
            'name'=> $request->name,
        ]);
        // $role -> name=$request->input('name');
        // $role->update();
        return response()->json($request);
    }


    /**
     * Remove the specified resource from storage.
     
     * @param  \App\Models\HfRole  $hfRole
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $role->delete();
        $res=HfRole::where('id',$id)->delete();
        return response()->json([$id]);
    }
}
