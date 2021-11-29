<?php

namespace App\Http\Controllers;

use App\Models\HfMemberEvaluation;
use Illuminate\Http\Request;

class HfAssessMarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = auth()->user();
        // if($user->marks->id == '1'){
        //     $HfMemberEvaluation = HfMemberEvaluation::all();
        //     return response()->json($HfMemberEvaluation);
        // }else{
        //     $HfMemberEvaluation = HfMemberEvaluation::where('parent_id',$user->marks->id)->get();
        //     if($HfMemberEvaluation){
        //         return response()->json($HfMemberEvaluation);
        //     }
        //     return response()->json(['msg'=>"No marks Assign Access"]);

        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        // try {
            $marks = HfMemberEvaluation::create([
                
                'marks'=>$request->marks,
                'family_member_id'=>$id,
                'date'=>date("Y-m-d"),
        
        
        
        
        ]);
            return response()->json($marks);
        // } catch (\Throwable $th) {
        //     return response()->json(['msg'=>"Dublicate Entry"],500);
        // }
        // return response();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfMemberEvaluation  $HfMemberEvaluation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //    $marks=HfMemberEvaluation::find($id);
       

    //     return response()->json($marks, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfMemberEvaluation  $HfMemberEvaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // $marks->update($request->all());
        // alert("reeeeee");
        // $marks=HfMemberEvaluation::find($id);
        // $marks->update([
        //     'name'=> $request->name,
        // ]);
        // // $marks -> name=$request->input('name');
        // // $marks->update();
        // return response()->json($request);
    }


    /**
     * Remove the specified resource from storage.
     
     * @param  \App\Models\HfMemberEvaluation  $HfMemberEvaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $marks->delete();
        // $res=HfMemberEvaluation::where('id',$id)->delete();
        // return response()->json([$id]);
    }
}
