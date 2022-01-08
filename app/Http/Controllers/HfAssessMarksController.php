<?php

namespace App\Http\Controllers;

use App\Models\HfMemberEvaluation;
use Illuminate\Http\Request;
use DB;
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
    // ddd
    public function store(Request $request,$id)
    {

        $data = $request->all();
        
        foreach ($data as $column ) {
           
            HfMemberEvaluation::create(
                [
                    
                    'family_member_id' => $id,
                    'type' => $column['test'],
                    'marks' => $column['marks'],
                    'asub_id' => $column['subjects'],
                    'date' => $column['month'],
                ]
            );

        }
                      return response()->json([
            'status' => 200,
            'res' => $data,
        ]);
        // try {
            // $kannada = 1 ; 
            // $english = 2 ;
            // $hindi = 3 ;
            // $maths = 4 ;
            // $arr = ['Kannada'=>1,'English'=>2,'Hindi'=>3,'Maths'=>4];
            // $arr = ['m1'=>'marks1',]



            // for($i = 0; $i < 5 ; $i++){
            //     $w = $i;
            //     $ma = $i;
            //         $week = 'week'.++$w;
            //         $marks = 'marks'.++$ma;
            //         $m = HfMemberEvaluation::create([
            //         'marks'=>$request->$marks,
            //         'type'=>$request->$week,
            //         'family_member_id'=>$id,
            //         'date'=>$request->month1,
            //         'asub_id'=>$kannada,
            //     ]);
            // }

           
                // $marks = HfMemberEvaluation::create([
                //     'marks'=>$request->marks1,
                //     'type'=>$request->week1,
                //     'family_member_id'=>$id,
                //     'date'=>$request->month1,
                //     'asub_id'=>$kannada,
                // ]);
            
           
            // $marks = HfMemberEvaluation::create([
                
            //     'marks'=>$request->marks1,
            //     'type'=>$request->week1,
            //     'family_member_id'=>$id,
            //     'date'=>$request->month1,
            //     // 'asub_id'=>$kannada,
            // ]);
            // $marks = HfMemberEvaluation::create([
                
            //     'marks'=>$request->marks2,
            //     'type'=>$request->week2,
            //     'family_member_id'=>$id,
            //     'date'=>$request->month2,
            //     'asub_id'=>$english,
            // ]);
            // $marks = HfMemberEvaluation::create([
                
            //     'marks'=>$request->marks3,
            //     'type'=>$request->week3,
            //     'family_member_id'=>$id,
            //     'date'=>$request->month3,
            //     'asub_id'=>$hindi,
            // ]);
            // $marks = HfMemberEvaluation::create([
                
            //     'marks'=>$request->marks4,
            //     'type'=>$request->week4,
            //     'family_member_id'=>$id,
            //     'date'=>$request->month4,
            //     'asub_id'=>$maths,
            // ]);




            
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
    
    public function AssessLineGraph($id)
    {

        $y = date('Y');

        $arr = [
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
            $mark = DB::table('hf_member_evaluations')
            ->where('date', 'like',$arr2[$i].'%')
            ->where('hf_member_evaluations.family_member_id','=',$id)
            ->get(['marks']);

            
            $l[] = $line = [
                'month' =>  $m[$i],
                'mark' => $mark,
            ];




        }



        return response()->json($l);
    }
    public function AicuLineChart($id,$year)
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



        $testarr = ['test1','test2','test3','test4'];
        

        foreach ($testarr as $key => $value) {
            $data[$value]  = $this -> getMarks($value,$id,$year);
        }

        return $data;

    }

    public function getMarks($test,$id,$year){

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
        $mark = DB::table('hf_member_evaluations')
            ->where('date', 'like',$arr2[$i].'%')
          
            ->where('hf_member_evaluations.family_member_id','=',$id)
            ->where('hf_member_evaluations.type','=',$test)
            ->get(['marks'])->sum('marks');

            $lm[] = $line = [
                            'month' =>  $m[$i],
                            'mark' => $mark,
                        ];
         }
            return $lm;
    }



    public function AicuCurveChart($id)
    {

        $y = date('Y');

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



        $testarr = ['test1','test2','test3','test4'];
        

        foreach ($testarr as $key => $value) {
            $data[$key]  = $this -> getMarks1($value,$id);
        }

        return $data;

    }

    public function getMarks1($test,$id){

        $y = date('Y');

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


        $mark = DB::table('hf_member_evaluations')
            ->where('hf_member_evaluations.family_member_id','=',$id)
            ->where('hf_member_evaluations.type','=',$test)
            ->get(['marks','asub_id','type','date']);

            $lm = $line = [
                            // 'month' =>  $m[$i],
                            'mark' => $mark,
                        ];
         
            return $lm;
            
    }













    public function AicuTableChart($id,$year)
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



        $testarr = ['test1','test2','test3','test4'];
        

        foreach ($testarr as $key => $value) {
            $data[$value]  = $this -> getMarks2($value,$id,$year);
        }

        return $data;

    }

    public function getMarks2($test,$id,$year){

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
        $mark = DB::table('hf_member_evaluations')
            ->where('hf_member_evaluations.family_member_id','=',$id)
            ->where('hf_member_evaluations.type','=',$test)
            ->where('date', 'like',$year.'%')
            ->join('hf_aicu_subjects','hf_aicu_subjects.name','hf_member_evaluations.asub_id')
            ->select('hf_member_evaluations.asub_id as bsub_id','hf_aicu_subjects.*','hf_member_evaluations.*')
            ->orderby('hf_aicu_subjects.asub_id','asc')
           
            ->get(['marks','asub_id','type','date']);

            // $lm = $line = [
            //                 // 'month' =>  $m[$i],
            //                 'mark' => $mark,
            //             ];
            }
            return $mark;
            
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

    public function getAllAicuMarks(Request $request,$id)
    {
        $allmarks = HfMemberEvaluation::where('family_member_id', $id)->get();
        if($allmarks){
            return response()->json($allmarks);
        }
        return response()->json(['msg'=>"There is no data"],500);
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
