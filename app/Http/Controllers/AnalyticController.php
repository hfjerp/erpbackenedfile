<?php

namespace App\Http\Controllers;

use App\Models\HfFamily;
use App\Models\HfFamilyMember;
use App\Models\HfJamath;
use App\Models\HfUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use DB;
class AnalyticController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function dashboard(Request $request)
    {
        $data = new Collection();
        $user = HfUser::where('id', $request->userId)->first();

        if(!$user){
            return response()->json(['msg'=>"There is no user by the userId ".$request->userId],500);
        }
        if ($user->role_id == 1) {
            $users = HfUser::all();
            if ($users) {
                $data['users'] = $users;
            }

            // get total families
            $families = HfFamily::all();
            if ($families) {
                $data['families'] = $families;
            }
            $bplfamilies = HfFamily::where('ration_card_type','=','BPL')->get();
            if ($bplfamilies) {
                $data['bplfamilies'] = $bplfamilies;
            }

            // get total jamaths
            // $jamaths = HfJamath::all();
            // if ($jamaths) {
            //     $data['jamaths'] = $jamaths;
            // }

        //     //Student List

        //     // $Student_family_members = HfFamilyMember::where('occupation_type','=','Student')->get();
        //     // if ($Student_family_members) {
        //     //     $data['Student_family_members'] = $Student_family_members;
        //     // }

        //     // --------------------------------------------

            $StudentCount = DB::table('hf_family_members')
            ->LeftJoin('hf_family_member_academies','hf_family_member_academies.family_member_id','hf_family_members.id')
            ->LeftJoin('hf_academic_details','hf_academic_details.id','hf_family_member_academies.academy_detail_id')
            ->select('hf_family_members.id as memberid','hf_family_member_academies.*','hf_academic_details.*','hf_family_members.*')

            ->where('occupation_type','=','Student')
            ->where('hf_family_member_academies.status','=',"Pursuing")
            ->where('hf_family_member_academies.type','=',"General")
            ->get();

            // get total family_members
            $family_members = HfFamilyMember::all();
            if ($family_members) {
                $data['family_members'] = $family_members;
            }

        }
        else{
            $users = HfUser::where(['parent_id'=>$user->id])->get();
            if ($users) {
                $data['users'] = $users;
            }

            // get total families
            $families = HfFamily::all();
            if ($families) {
                $data['families'] = $families;
            }

            // get total jamaths
            $jamaths = HfJamath::all();
            if ($jamaths) {
                $data['jamaths'] = $jamaths;
            }

            // get total family_members
            $family_members = HfFamilyMember::all();
            if ($family_members) {
                $data['family_members'] = $family_members;
            }

        }
        return response()->json([
            'st'=>$StudentCount,
            'data'=>$data,


        ]);

    }

    public function dashboard2($id)
    {
        $ress = DB::table('hf_families')
        ->where('hf_families.jamath_id','=',$id)
        ->get();
        $sum = 0;
      
        for($i = 0;$i < count($ress);$i++){
            $ids = $ress[$i]->id;
            $resss = DB::table('hf_family_members')
            ->where('hf_family_members.family_id','=',$ids)
            ->get();
            $a = $resss->count();
            $sum = $sum + $a;
        } 
        $student=0;
        for($i = 0;$i < count($ress);$i++){
            $idss = $ress[$i]->id;
            $ressd = DB::table('hf_family_members')
            ->LeftJoin('hf_family_member_academies','hf_family_member_academies.family_member_id','hf_family_members.id')
            ->LeftJoin('hf_academic_details','hf_academic_details.id','hf_family_member_academies.academy_detail_id')
    
            ->where('hf_family_members.family_id','=',$idss)
            ->where('hf_family_members.occupation_type','=',"Student")
            ->where('hf_family_member_academies.type','=',"General")
            // ->where('hf_family_member_academies.type','=',"General")
            ->where('hf_family_member_academies.status','=',"Pursuing")
            ->get();
            $a = $ressd->count();
            $student = $student + $a;
        }
        $bpl = DB::table('hf_families')
        ->where('hf_families.jamath_id','=',$id)
        ->where('hf_families.ration_card_type','=','BPL')
        ->get();
        return response()->json([
            'family' => $ress,
            'familyMembers' => $sum,
            'familyStudent' => $student,
            'familyBpl' => $bpl,
        ]);
    }

    public function dashboard3($id)
    {

        $sum = 0;

        $fams = DB::table('hf_families')
        ->where('hf_families.jamath_id','=',$id)
        ->get();
      
        for($i = 0;$i < count($fams);$i++){
            $ids = $fams[$i]->id;

            $resss = DB::table('hf_family_members')

        ->where('hf_family_members.family_id','=',$ids)
        ->get();
        $a = $resss->count();
        $sum = $sum + $a;

        }

        echo response()->json($sum);


        
      
        
        

    }






}
