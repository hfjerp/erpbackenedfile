<?php

namespace App\Http\Controllers;

use App\Models\HfMemberSubjectEvaluations;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HfMemberSubjectEvaluationController extends Controller
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
    public function store(Request $request,$id)
    {
        $data = $request->all();
        $accountCategoryId = $request->account_category_id;
        foreach ($data as $column ) {
           
            HfMemberSubjectEvaluations::create(
                [
                    'family_member_id' => $id,
                    'sub_name' => $column['subject'],
                    'marks' => $column['marks'],
                    'date' => date("Y-m-d"),
                ]
            );

        }
                      return response()->json([
            'status' => 200,
            'res' => $data,
        ]);
    }



    public function HfMemberSubjectEvaluationsnewstore(Request $request,$fieldname,$jam)
    {
        // $data = $request->all();
        // // $accountCategoryId = $request->account_category_id;
        // foreach ($data as $column ) {
        // if($request->status == "lock"){
        //     HfMemberSubjectEvaluations::create(
        //         [
        //             'jamath_id' => $jam,
        //             'access_name' => $fieldname,
                    
        //         ]
        //     );
        //     return response()->json([
        //         'status' => 200,
        //         'res' => "iam devil",
        //     ]);
        // }else{

        // $res=HfMemberSubjectEvaluations::where('jamath_id',$jam)
        // ->where('access_name',$fieldname)
        
        
        // ->delete();


        //     return response()->json([
        //         'status' => 200,
        //         'res' => "iam delete",
        //     ]);
    
        // }
           

        
       


    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfMemberSubjectEvaluations  $HfMemberSubjectEvaluations
     * @return \Illuminate\Http\Response
     */
    public function show(HfMemberSubjectEvaluations $HfMemberSubjectEvaluations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfMemberSubjectEvaluations  $HfMemberSubjectEvaluations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfMemberSubjectEvaluations $HfMemberSubjectEvaluations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfMemberSubjectEvaluations  $HfMemberSubjectEvaluations
     * @return \Illuminate\Http\Response
     */
    public function destroy($fieldname,$jam)
    {
        // $role->delete();
        // $res=HfMemberSubjectEvaluations::where('family_member_id',$jam)
        // ->where('access_name',$fieldname)
        
        
        // ->delete();
        // return response()->json([$jam]);
    }

    public function HfMemberSubjectEvaluationsAccess(Request $request)
    {
        // $HfMemberSubjectEvaluationsList = HfMemberSubjectEvaluations::where('jamath_id', $request->jamath_id)->get();
        // if($HfMemberSubjectEvaluationsList){
        //     return response()->json($HfMemberSubjectEvaluationsList);
        // }
        // return response()->json(['msg'=>"There is no HfMemberSubjectEvaluations access"],500);
    } 
    
    public function HfMemberSubjectEvaluationsAccessSA(Request $request,$id)
    {
        // $HfMemberSubjectEvaluationsList = HfMemberSubjectEvaluations::where('jamath_id', $id)->get();
        // if($HfMemberSubjectEvaluationsList){
        //     return response()->json($HfMemberSubjectEvaluationsList);
        // }
        // return response()->json(['msg'=>"There is no HfMemberSubjectEvaluations access"],500);
    }
}
