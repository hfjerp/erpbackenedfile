<?php

namespace App\Http\Controllers;

use App\Models\HfMemberEduAssess;
use Illuminate\Http\Request;
use DB;
class HfEduAssessController extends Controller
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
        //     $HfMemberEduAssess = HfMemberEduAssess::all();
        //     return response()->json($HfMemberEduAssess);
        // }else{
        //     $HfMemberEduAssess = HfMemberEduAssess::where('parent_id',$user->marks->id)->get();
        //     if($HfMemberEduAssess){
        //         return response()->json($HfMemberEduAssess);
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
            $marks = HfMemberEduAssess::create([
                
                'percentage'=>$request->marks,
                'board' => $request->board,
                'course'=>$request->course,
                'year'=>$request->year,
                'family_member_id'=>$id,
                
        
        
        
        
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
     * @param  \App\Models\HfMemberEduAssess  $HfMemberEduAssess
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //    $marks=HfMemberEduAssess::find($id);
       

    //     return response()->json($marks, 200);
    }
    
    public function EduAssessLineGraph($id)
    {

        $Eduline = DB::table('hf_member_edu_assesses')
        ->where('hf_member_edu_assesses.family_member_id','=',$id)
        ->orderby('year','ASC')
        ->get();




        



        return response()->json($Eduline);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfMemberEduAssess  $HfMemberEduAssess
     * @return \Illuminate\Http\Response
     */
    // ssssssssss
    public function update2(Request $request,$id)
    {
        $marks = DB::table('hf_member_edu_assesses')
        ->where('edu_id',$id)
        ->update(array(


            'percentage'=>$request->marks,
            'course'=>$request->course,
            'year'=>$request->year,

        ));
        
          
            
            
    
    
    
    

        return response()->json($marks);



    }


    /**
     * Remove the specified resource from storage.
     
     * @param  \App\Models\HfMemberEduAssess  $HfMemberEduAssess
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $marks->delete();
        // $res=HfMemberEduAssess::where('id',$id)->delete();
        // return response()->json([$id]);
    }
}
