<?php

namespace App\Http\Controllers;

use App\Models\HfMemberSkillEvaluation;
use Illuminate\Http\Request;
use DB;
class HfMemberSkillEvaluationController extends Controller
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
        //     $HfMemberSkillEvaluationController = HfMemberSkillEvaluationController::all();
        //     return response()->json($HfMemberSkillEvaluationController);
        // }else{
        //     $HfMemberSkillEvaluationController = HfMemberSkillEvaluationController::where('parent_id',$user->marks->id)->get();
        //     if($HfMemberSkillEvaluationController){
        //         return response()->json($HfMemberSkillEvaluationController);
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


            $communication = 1 ; 
            $teamwork = 2 ;
            $initiative = 3 ;
            $leadership = 4 ;
            $planning = 5 ;

            $marks = HfMemberSkillEvaluation::create([
                
                'marks'=>$request->communication,
                'skl_id'=>$communication,
                'family_member_id'=>$id,
                'date'=>date("Y-m-d"),
            ]); 
            $marks = HfMemberSkillEvaluation::create([
                'marks'=>$request->teamwork,
                'skl_id'=>$teamwork,
                'family_member_id'=>$id,
                'date'=>date("Y-m-d"),
            ]);
            
            $marks = HfMemberSkillEvaluation::create([
                'marks'=>$request->initiative,
                'skl_id'=>$initiative,
                'family_member_id'=>$id,
                'date'=>date("Y-m-d"),
            ]);
                $marks = HfMemberSkillEvaluation::create([
                'marks'=>$request->leadership,
                'skl_id'=>$leadership,
                'family_member_id'=>$id,
                'date'=>date("Y-m-d"),

                ]);
                $marks = HfMemberSkillEvaluation::create([
                'marks'=>$request->planning,
                'skl_id'=>$planning,
                'family_member_id'=>$id,
                'date'=>date("Y-m-d"),
        
        
        
        
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
     * @param  \App\Models\HfMemberSkillEvaluationController  $HfMemberSkillEvaluationController
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //    $marks=HfMemberSkillEvaluationController::find($id);
       

    //     return response()->json($marks, 200);
    }
    
    public function SkillAssessLineGraph($id)
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

        for($i = 0;$i < count($arr2); $i++ ){
            $mark = DB::table('hf_member_skill_evaluations')
            ->where('date', 'like',$arr2[$i].'%')
          
            ->where('hf_member_skill_evaluations.family_member_id','=',$id)
            ->orderby('hf_member_skill_evaluations.skl_id','ASC')
            ->get(['marks']);
            $skilltype = DB::table('hf_skill_lists')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_member_skill_evaluations','hf_member_skill_evaluations.skl_id','hf_skill_lists.skl_id')
            ->where('hf_member_skill_evaluations.family_member_id','=',$id)
            ->orderby('hf_member_skill_evaluations.skl_id','ASC')
            ->get(['name']);

            
            $l[] = $line = [
                'month' =>  $m[$i],
                'mark' => $mark,
                'skilltype' => $skilltype,
            ];




        }



        return response()->json($l);
    }
    public function ComSkillAssesspie($id)
    {

        $y = date('Y');

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
            $mark = DB::table('hf_member_skill_evaluations')
            ->where('date', 'like',$arr2[$i].'%')
            ->RightJoin('hf_skill_lists','hf_skill_lists.skl_id','hf_member_skill_evaluations.skl_id')

            ->where('hf_member_skill_evaluations.family_member_id','=',$id)
            ->where('hf_skill_lists.name','=','Communication')
            // ->orderby('hf_member_skill_evaluations.skl_id','ASC')
            ->get(['marks']);
            $skilltype = DB::table('hf_skill_lists')
            ->where('date', 'like',$arr2[$i].'%')
            ->RightJoin('hf_member_skill_evaluations','hf_member_skill_evaluations.skl_id','hf_skill_lists.skl_id')
            ->where('hf_member_skill_evaluations.family_member_id','=',$id)
            ->where('hf_skill_lists.name','=','Communication')
            // ->orderby('hf_member_skill_evaluations.skl_id','ASC')
            ->get(['name']);

            
            $l[] = $line = [
                'cmonth' =>  $m[$i],
                'cmark' => $mark,
                'cskilltype' => $skilltype,
            ];




        }



        return response()->json($l);
    }



    public function TeamSkillAssesspie($id)
    {

        $y = date('Y');

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
            $mark = DB::table('hf_member_skill_evaluations')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_skill_lists','hf_skill_lists.skl_id','hf_member_skill_evaluations.skl_id')

            ->where('hf_member_skill_evaluations.family_member_id','=',$id)
            ->where('hf_skill_lists.name','=','TeamWork')
            ->orderby('hf_member_skill_evaluations.skl_id','ASC')
            ->get(['marks']);
            $skilltype = DB::table('hf_skill_lists')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_member_skill_evaluations','hf_member_skill_evaluations.skl_id','hf_skill_lists.skl_id')
            ->where('hf_member_skill_evaluations.family_member_id','=',$id)
            ->where('hf_skill_lists.name','=','TeamWork')
            ->orderby('hf_member_skill_evaluations.skl_id','ASC')
            ->get(['name']);

            
            $l[] = $line = [
                'tmonth' =>  $m[$i],
                'tmark' => $mark,
                'tskilltype' => $skilltype,
            ];




        }



        return response()->json($l);
    }
    public function IniSkillAssesspie($id)
    {

        $y = date('Y');

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
            $mark = DB::table('hf_member_skill_evaluations')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_skill_lists','hf_skill_lists.skl_id','hf_member_skill_evaluations.skl_id')

            ->where('hf_member_skill_evaluations.family_member_id','=',$id)
            ->where('hf_skill_lists.name','=','Initiative')
            ->orderby('hf_member_skill_evaluations.skl_id','ASC')
            ->get(['marks']);
            $skilltype = DB::table('hf_skill_lists')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_member_skill_evaluations','hf_member_skill_evaluations.skl_id','hf_skill_lists.skl_id')
            ->where('hf_member_skill_evaluations.family_member_id','=',$id)
            ->where('hf_skill_lists.name','=','Initiative')
            ->orderby('hf_member_skill_evaluations.skl_id','ASC')
            ->get(['name']);

            
            $l[] = $line = [
                'imonth' =>  $m[$i],
                'imark' => $mark,
                'iskilltype' => $skilltype,
            ];




        }



        return response()->json($l);
    }


    public function LeaSkillAssesspie($id)
    {

        $y = date('Y');

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
            $mark = DB::table('hf_member_skill_evaluations')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_skill_lists','hf_skill_lists.skl_id','hf_member_skill_evaluations.skl_id')

            ->where('hf_member_skill_evaluations.family_member_id','=',$id)
            ->where('hf_skill_lists.name','=','Leadership')
            ->orderby('hf_member_skill_evaluations.skl_id','ASC')
            ->get(['marks']);
            $skilltype = DB::table('hf_skill_lists')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_member_skill_evaluations','hf_member_skill_evaluations.skl_id','hf_skill_lists.skl_id')
            ->where('hf_member_skill_evaluations.family_member_id','=',$id)
            ->where('hf_skill_lists.name','=','Leadership')
            ->orderby('hf_member_skill_evaluations.skl_id','ASC')
            ->get(['name']);

            
            $l[] = $line = [
                'lmonth' =>  $m[$i],
                'lmark' => $mark,
                'lskilltype' => $skilltype,
            ];




        }



        return response()->json($l);
    }

    public function PlanSkillAssesspie($id)
    {

        $y = date('Y');

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
            $mark = DB::table('hf_member_skill_evaluations')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_skill_lists','hf_skill_lists.skl_id','hf_member_skill_evaluations.skl_id')

            ->where('hf_member_skill_evaluations.family_member_id','=',$id)
            ->where('hf_skill_lists.name','=','Planning')
            ->orderby('hf_member_skill_evaluations.skl_id','ASC')
            ->get(['marks']);
            $skilltype = DB::table('hf_skill_lists')
            ->where('date', 'like',$arr2[$i].'%')
            ->join('hf_member_skill_evaluations','hf_member_skill_evaluations.skl_id','hf_skill_lists.skl_id')
            ->where('hf_member_skill_evaluations.family_member_id','=',$id)
            ->where('hf_skill_lists.name','=','Planning')
            ->orderby('hf_member_skill_evaluations.skl_id','ASC')
            ->get(['name']);

            
            $l[] = $line = [
                'pmonth' =>  $m[$i],
                'pmark' => $mark,
                'pskilltype' => $skilltype,
            ];




        }



        return response()->json($l);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfMemberSkillEvaluationController  $HfMemberSkillEvaluationController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // $marks->update($request->all());
        // alert("reeeeee");
        // $marks=HfMemberSkillEvaluationController::find($id);
        // $marks->update([
        //     'name'=> $request->name,
        // ]);
        // // $marks -> name=$request->input('name');
        // // $marks->update();
        // return response()->json($request);
    }


    /**
     * Remove the specified resource from storage.
     
     * @param  \App\Models\HfMemberSkillEvaluationController  $HfMemberSkillEvaluationController
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $marks->delete();
        // $res=HfMemberSkillEvaluationController::where('id',$id)->delete();
        // return response()->json([$id]);
    }
}
