<?php

namespace App\Http\Controllers;

use App\Models\HfMemberValuesEvaluations;
use Illuminate\Http\Request;
use DB;
class HfMemberValuesEvaluationsController extends Controller
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
        //     $HfMemberValuesEvaluationsController = HfMemberValuesEvaluationsController::all();
        //     return response()->json($HfMemberValuesEvaluationsController);
        // }else{
        //     $HfMemberValuesEvaluationsController = HfMemberValuesEvaluationsController::where('parent_id',$user->marks->id)->get();
        //     if($HfMemberValuesEvaluationsController){
        //         return response()->json($HfMemberValuesEvaluationsController);
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
        // $data = $request->all();


            $patience = 1 ; 
            $simplicity = 2 ;
            $discipline = 3 ;
            $honesty = 4 ;
            $confidence = 5 ;

            $marks = HfMemberValuesEvaluations::create([
                
                'marks'=>$request->patience,
                'val_id'=>$patience,
                'family_member_id'=>$id,
                'date'=>$request->month,
            ]); 
            $marks = HfMemberValuesEvaluations::create([
                'marks'=>$request->simplicity,
                'val_id'=>$simplicity,
                'family_member_id'=>$id,
                'date'=>$request->month,
            ]);
            
            $marks = HfMemberValuesEvaluations::create([
                'marks'=>$request->discipline,
                'val_id'=>$discipline,
                'family_member_id'=>$id,
                'date'=>$request->month,
            ]);
                $marks = HfMemberValuesEvaluations::create([
                'marks'=>$request->honesty,
                'val_id'=>$honesty,
                'family_member_id'=>$id,
                'date'=>$request->month,

                ]);
                $marks = HfMemberValuesEvaluations::create([
                'marks'=>$request->confidence,
                'val_id'=>$confidence,
                'family_member_id'=>$id,
                'date'=>$request->month,
        
        
        
        
        ]);
      
                      return response()->json([
            'status' => 200,
            'res' => $marks,
        ]);

        
        
        
        
    
        // } catch (\Throwable $th) {
        //     return response()->json(['msg'=>"Dublicate Entry"],500);
        // }
        // return response();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfMemberValuesEvaluationsController  $HfMemberValuesEvaluationsController
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //    $marks=HfMemberValuesEvaluationsController::find($id);
       

    //     return response()->json($marks, 200);
    }
    
    public function ValueAssessLineGraph($id,$year)
    {

        $y = $year;

        $arr = [
            'dummy' => '100',
            'Jan' => '01',
            'Feb' => '02',
            'Mar' => '03',
            'Apr' => '04',
            'May' => '05',
            'Jun' => '06',
            'Jul' => '07',
            'Aug' => '08',
            'Sep' => '09',
            'Oct' => '10',
            'Nov' => '11',
            'Dec' => '12',
        ];
        foreach ($arr as $key => $value) {
            $arr2[] = $y."-".$value; 
            $m[] = $key;
       
        }

        for($i = 0;$i < count($arr2); $i++ ){
            $mark = DB::table('hf_member_values_evaluations')
            ->where('date', 'like',$arr2[$i].'%')
          
            ->where('hf_member_values_evaluations.family_member_id','=',$id)
            ->orderby('hf_member_values_evaluations.val_id','ASC')
            ->get(['marks']);
            $valuetype = DB::table('hf_values_lists')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_member_values_evaluations','hf_member_values_evaluations.val_id','hf_values_lists.val_id')
            ->where('hf_member_values_evaluations.family_member_id','=',$id)
            ->orderby('hf_member_values_evaluations.val_id','ASC')
            ->get(['name']);

            
            $l[] = $line = [
                'month' =>  $m[$i],
                'mark' => $mark,
                'valuetype' => $valuetype,
            ];




        }



        return response()->json($l);
    }
    public function PatienceAssesspie($id,$year)
    {

        $y = $year;

        $arr = [
            // 'dummy' => '100',
            'Jan' => '01',
            'Feb' => '02',
            'Mar' => '03',
            'Apr' => '04',
            'May' => '05',
            'Jun' => '06',
            'Jul' => '07',
            'Aug' => '08',
            'Sep' => '09',
            'Oct' => '10',
            'Nov' => '11',
            'Dec' => '12',
        ];
        foreach ($arr as $key => $value) {
            $arr2[] = $y."-".$value; 
            $m[] = $key;
       
        }

        for($i = 0;$i < count($arr2); $i++ ){
            $mark = DB::table('hf_member_values_evaluations')
            ->where('date', 'like',$arr2[$i].'%')
            ->RightJoin('hf_values_lists','hf_values_lists.val_id','hf_member_values_evaluations.val_id')

            ->where('hf_member_values_evaluations.family_member_id','=',$id)
            ->where('hf_values_lists.name','=','Patience')
            // ->orderby('hf_member_values_evaluations.val_id','ASC')
            ->get(['marks']);
            $valuetype = DB::table('hf_values_lists')
            ->where('date', 'like',$arr2[$i].'%')
            ->RightJoin('hf_member_values_evaluations','hf_member_values_evaluations.val_id','hf_values_lists.val_id')
            ->where('hf_member_values_evaluations.family_member_id','=',$id)
            ->where('hf_values_lists.name','=','Patience')
            // ->orderby('hf_member_values_evaluations.val_id','ASC')
            ->get(['name']);

            
            $l[] = $line = [
                'pmonth' =>  $m[$i],
                'pmark' => $mark,
                'pvaluetype' => $valuetype,
            ];




        }



        return response()->json($l);
    }



    public function SimplicityAssesspie($id,$year)
    {

        $y = $year;

        $arr = [
            // 'dummy' => '100',
            'Jan' => '01',
            'Feb' => '02',
            'Mar' => '03',
            'Apr' => '04',
            'May' => '05',
            'Jun' => '06',
            'Jul' => '07',
            'Aug' => '08',
            'Sep' => '09',
            'Oct' => '10',
            'Nov' => '11',
            'Dec' => '12',
        ];
        foreach ($arr as $key => $value) {
            $arr2[] = $y."-".$value; 
            $m[] = $key;
       
        }

        for($i = 0;$i < count($arr2); $i++ ){
            $mark = DB::table('hf_member_values_evaluations')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_values_lists','hf_values_lists.val_id','hf_member_values_evaluations.val_id')

            ->where('hf_member_values_evaluations.family_member_id','=',$id)
            ->where('hf_values_lists.name','=','Simplicity')
            ->orderby('hf_member_values_evaluations.val_id','ASC')
            ->get(['marks']);
            $valuestype = DB::table('hf_values_lists')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_member_values_evaluations','hf_member_values_evaluations.val_id','hf_values_lists.val_id')
            ->where('hf_member_values_evaluations.family_member_id','=',$id)
            ->where('hf_values_lists.name','=','Simplicity')
            ->orderby('hf_member_values_evaluations.val_id','ASC')
            ->get(['name']);

            
            $l[] = $line = [
                'smonth' =>  $m[$i],
                'smark' => $mark,
                'svaluestype' => $valuestype,
            ];




        }



        return response()->json($l);
    }
    public function DisciplineAssesspie($id,$year)
    {

        $y = $year;

        $arr = [
            // 'dummy' => '100',
            'Jan' => '01',
            'Feb' => '02',
            'Mar' => '03',
            'Apr' => '04',
            'May' => '05',
            'Jun' => '06',
            'Jul' => '07',
            'Aug' => '08',
            'Sep' => '09',
            'Oct' => '10',
            'Nov' => '11',
            'Dec' => '12',
        ];
        foreach ($arr as $key => $value) {
            $arr2[] = $y."-".$value; 
            $m[] = $key;
       
        }

        for($i = 0;$i < count($arr2); $i++ ){
            $mark = DB::table('hf_member_values_evaluations')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_values_lists','hf_values_lists.val_id','hf_member_values_evaluations.val_id')

            ->where('hf_member_values_evaluations.family_member_id','=',$id)
            ->where('hf_values_lists.name','=','Discipline')
            ->orderby('hf_member_values_evaluations.val_id','ASC')
            ->get(['marks']);
            $valuestype = DB::table('hf_values_lists')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_member_values_evaluations','hf_member_values_evaluations.val_id','hf_values_lists.val_id')
            ->where('hf_member_values_evaluations.family_member_id','=',$id)
            ->where('hf_values_lists.name','=','Discipline')
            ->orderby('hf_member_values_evaluations.val_id','ASC')
            ->get(['name']);

            
            $l[] = $line = [
                'dmonth' =>  $m[$i],
                'dmark' => $mark,
                'dvaluestype' => $valuestype,
            ];




        }



        return response()->json($l);
    }


    public function HonestyAssesspie($id,$year)
    {

        $y = $year;

        $arr = [
            // 'dummy' => '100',
            'Jan' => '01',
            'Feb' => '02',
            'Mar' => '03',
            'Apr' => '04',
            'May' => '05',
            'Jun' => '06',
            'Jul' => '07',
            'Aug' => '08',
            'Sep' => '09',
            'Oct' => '10',
            'Nov' => '11',
            'Dec' => '12',
        ];
        foreach ($arr as $key => $value) {
            $arr2[] = $y."-".$value; 
            $m[] = $key;
       
        }

        for($i = 0;$i < count($arr2); $i++ ){
            $mark = DB::table('hf_member_values_evaluations')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_values_lists','hf_values_lists.val_id','hf_member_values_evaluations.val_id')

            ->where('hf_member_values_evaluations.family_member_id','=',$id)
            ->where('hf_values_lists.name','=','Honesty')
            ->orderby('hf_member_values_evaluations.val_id','ASC')
            ->get(['marks']);
            $valuestype = DB::table('hf_values_lists')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_member_values_evaluations','hf_member_values_evaluations.val_id','hf_values_lists.val_id')
            ->where('hf_member_values_evaluations.family_member_id','=',$id)
            ->where('hf_values_lists.name','=','Honesty')
            ->orderby('hf_member_values_evaluations.val_id','ASC')
            ->get(['name']);

            
            $l[] = $line = [
                'hmonth' =>  $m[$i],
                'hmark' => $mark,
                'hvaluestype' => $valuestype,
            ];




        }



        return response()->json($l);
    }

    public function ConfidenceAssesspie($id,$year)
    {

        $y = $year;

        $arr = [
            // 'dummy' => '100',
            'Jan' => '01',
            'Feb' => '02',
            'Mar' => '03',
            'Apr' => '04',
            'May' => '05',
            'Jun' => '06',
            'Jul' => '07',
            'Aug' => '08',
            'Sep' => '09',
            'Oct' => '10',
            'Nov' => '11',
            'Dec' => '12',
        ];
        foreach ($arr as $key => $value) {
            $arr2[] = $y."-".$value; 
            $m[] = $key;
       
        }

        for($i = 0;$i < count($arr2); $i++ ){
            $mark = DB::table('hf_member_values_evaluations')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_values_lists','hf_values_lists.val_id','hf_member_values_evaluations.val_id')

            ->where('hf_member_values_evaluations.family_member_id','=',$id)
            ->where('hf_values_lists.name','=','Confidence')
            ->orderby('hf_member_values_evaluations.val_id','ASC')
            ->get(['marks']);
            $valuestype = DB::table('hf_values_lists')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_member_values_evaluations','hf_member_values_evaluations.val_id','hf_values_lists.val_id')
            ->where('hf_member_values_evaluations.family_member_id','=',$id)
            ->where('hf_values_lists.name','=','Confidence')
            ->orderby('hf_member_values_evaluations.val_id','ASC')
            ->get(['name']);

            
            $l[] = $line = [
                'cmonth' =>  $m[$i],
                'cmark' => $mark,
                'cvaluestype' => $valuestype,
            ];




        }



        return response()->json($l);
    }


    public function ValueTableChart($id,$year)
    {

        $y = $year;

        $arr = [
            'dummy' => '100',
            'Jan' => '01',
            'Feb' => '02',
            'Mar' => '03',
            'Apr' => '04',
            'May' => '05',
            'Jun' => '06',
            'Jul' => '07',
            'Aug' => '08',
            'Sep' => '09',
            'Oct' => '10',
            'Nov' => '11',
            'Dec' => '12',
        ];
        foreach ($arr as $key => $value) {
            $arr2[] = $y."-".$value; 
            $m[] = $key;
       
        }

        for($i = 0;$i < count($arr2); $i++ ){
            $mark = DB::table('hf_member_values_evaluations')
            ->where('hf_member_values_evaluations.family_member_id','=',$id)
            ->where('date', 'like',$year.'%')
            ->join('hf_values_lists','hf_values_lists.val_id','hf_member_values_evaluations.val_id')
            ->select('hf_values_lists.val_id as values_table_id','hf_values_lists.*','hf_member_values_evaluations.*')
            ->get(['marks','val_id','date']);
            
            



        }



        return response()->json($mark);
    }


    public function updatevaluemark(Request $request,$id)
    {
        $eval=HfMemberValuesEvaluations::where('value_id',$id);
        $eval->update([
            'date'=> $request->date,
            'marks'=> $request->marks,
        ]);
        // $role -> name=$request->input('name');
        // $role->update();
        return response()->json($request);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfMemberValuesEvaluationsController  $HfMemberValuesEvaluationsController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // $marks->update($request->all());
        // alert("reeeeee");
        // $marks=HfMemberValuesEvaluationsController::find($id);
        // $marks->update([
        //     'name'=> $request->name,
        // ]);
        // // $marks -> name=$request->input('name');
        // // $marks->update();
        // return response()->json($request);
    }


    /**
     * Remove the specified resource from storage.
     
     * @param  \App\Models\HfMemberValuesEvaluationsController  $HfMemberValuesEvaluationsController
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $marks->delete();
        // $res=HfMemberValuesEvaluationsController::where('id',$id)->delete();
        // return response()->json([$id]);
    }
}
