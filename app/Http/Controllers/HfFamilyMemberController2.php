<?php

namespace App\Http\Controllers;

use App\Models\HfAcademicDetail;
use App\Models\HfContact;
use App\Models\HfFamilyHead;
use App\Models\HfFamilyMember;
use App\Models\HfFamily;
use App\Models\HfFamilyMemberAadhar;
use App\Models\HfFamilyMemberAcademy;
use App\Models\HfFamilyMemberAcademySupport;
use App\Models\HfFamilyMemberBank;
use App\Models\HfFamilyMemberContact;
use App\Models\HfFamilyMemberGoal;
use App\Models\HfFamilyMemberHealth;
use App\Models\HfFamilyMemberHealthDetail;
use App\Models\HfFamilyMemberHobby;
use App\Models\HfFamilyMemberLabour;
use App\Models\HfFamilyMemberOccupationSupport;
use App\Models\HfFamilyMemberOtherCourse;
use App\Models\HfFamilyMemberPrioritySupport;
use App\Models\HfFamilyMemberSeniorCitizen;
use App\Models\HfFamilyMemberSkill;
use App\Models\HfFamilyMemberVoterId;
use App\Models\HfOccupationDetail;
use Illuminate\Http\Request;
use DB;
// use Carbon\Carbon;

class HfFamilyMemberController2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $familyMember = HfFamilyMember::create([
            'name' => $request->name,
            'family_id' => $request->family_id,
            'blood_group' => $request->blood_group,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'occupation_type' => $request->occupation_type,
            'relationship' => $request->relationship,
        ]);

        // ---------------
        $contact_list = [];

        $tempArray = json_decode($request->contacts, true);
        foreach ((array)$tempArray as $contact) {
            $contct = HfContact::create([
                'contact_type' => $contact['type']['name'],
                'value' => $contact['value'],
            ]);
            array_push($contact_list, $contct->id);
        }

        foreach ($contact_list as $contact) {
            HfFamilyMemberContact::create([
                'contact_id'=>$contact,
                'family_member_id'=>$familyMember->id,
            ]);
        }
        // -------------
        if($request->occupation_type == "Business Owner" || "Job"){
            HfOccupationDetail::create([
                'family_member_id' => $familyMember->id,
                'occupation' => $request->occupation_type,
                'workplace_name' => $request->work_place_name,
                'workplace_address' => $request->work_place_address,
                'income' => $request->income,
            ]);
        }

        if($request->gen_education_type) {
            $academyDetail = HfAcademicDetail::create([
                'academic_year' => $request->academic_year,
                'major' => $request->major,
                'class' => $request->academy_class,
                'academy_name' => $request->academy_name,
                'academic_medium' => $request->medium,
            ]);

            HfFamilyMemberAcademy::create([
                "family_member_id" => $familyMember->id,
                "academy_detail_id" => $academyDetail->id,
                "current_academy" => $academyDetail->id,
                'status' => $request->gen_status,
                "type" => $request->gen_education_type,


            ]);
        }

        if($request->rel_education_type) {
            $academyDetail = HfAcademicDetail::create([
                'academic_year' => $request->academic_year,
                'major' => $request->major,
                'class' => $request->academy_class,
                'academy_name' => $request->academy_name,
                'academic_medium' => $request->medium,
            ]);

            HfFamilyMemberAcademy::create([
                "family_member_id" => $familyMember->id,
                "academy_detail_id" => $academyDetail->id,
                'status' => $request->gen_status,
                'type' => $request->rel_education_type,

                // "current_academy" => $academyDetail->id,
            ]);
        }

        $profileImgPath = null;
        if($request->file('profile_img_url')){
            $profileImgPath = $request->file('profile_img_url')->move('familyMember/'.$familyMember->id.'/profileImg/');
            $familyMember->update([
                'profile_img_url' => $profileImgPath,
            ]);
        }
        // ---------Aadhar ---------------------
        $aadharCardImgPath = null;

        if($request->file('aadhar_card_img_url')){
            $aadharCardImgPath = $request->file('aadhar_card_img_url')->move('familyMember/' . $familyMember->id . '/aadharCardImg/');
        }

        HfFamilyMemberAadhar::create([
            'aadhar_card_no'=> $request->aadhar_card_no,
            'aadhar_card_img_url'=> $aadharCardImgPath,
            'family_member_id' => $familyMember->id
        ]);

        // ---------- Voter Id ---------------
        $voterIdCardImgPath = null;

        if ($request->file('voter_id_card_img_url')) {
            $voterIdCardImgPath = $request->file('voter_id_card_img_url')->move('familyMember/' . $familyMember->id . '/voterIdCardImg/');
        }

        HfFamilyMemberVoterId::create([
            'voter_id_card_no' => $request->voter_id_no,
            'voter_id_card_img_url' => $voterIdCardImgPath,
            'family_member_id' => $familyMember->id
        ]);

        // ---------- Bank Detail ---------------
        $passbookPath = null;
        if ($request->file('passbook_url')) {
            $passbookPath = $request->file('passbook_url')->move('familyMember/' . $familyMember->id . '/passbook/');
        }

        HfFamilyMemberBank::create([
            'account_no' => $request->account_number,
            'passbook_url' => $passbookPath,
            'family_member_id' => $familyMember->id
        ]);

        // ---------- Health Card ---------------
        $healthImgPath = null;
        if ($request->file('health_card_img_url')) {
            $healthImgPath = $request->file('health_card_img_url')->move('familyMember/' . $familyMember->id . '/healthCardImg/');
        }

        HfFamilyMemberHealth::create([
            'health_card_no' => $request->health_card_no,
            'health_card_img_url' => $healthImgPath,
            'family_member_id' => $familyMember->id
        ]);

        // ---------- Labour Card ---------------
        $labourImgPath = null;
        if ($request->file('labour_card_img_url')) {
            $labourImgPath = $request->file('labour_card_img_url')->move('familyMember/' . $familyMember->id . '/labourCardImg/');
        }

        HfFamilyMemberLabour::create([
            'labour_card_no' => $request->labour_card_no,
            'labour_card_img_url' => $labourImgPath,
            'family_member_id' => $familyMember->id
        ]);

        // ---------- Senior Card ---------------
        $sCitizenImgPath = null;
        if ($request->file('senior_citizen_card_img_url')) {
            $sCitizenImgPath = $request->file('senior_citizen_card_img_url')->move('familyMember/' . $familyMember->id . '/sCitizenCardImg/');
        }

        HfFamilyMemberSeniorCitizen::create([
            'senior_citizen_card_no' => $request->senior_citizen_card_no,
            'senior_citizen_card_img_url' => $sCitizenImgPath,
            'family_member_id' => $familyMember->id
        ]);

        // saving the family member health details
        HfFamilyMemberHealthDetail::create([
            'family_member_id' => $familyMember->id,
            'disease' => $request->disease,
            'since' => $request->since,
            'status' => $request->health_status,
            'place' => $request->hospital_place,
            'hospital' => $request->hospital,
            'exercise' => $request->exercise,
        ]);

        if ($request->isHead == "true") {
            HfFamilyHead::create([
                'family_member_id' => $familyMember->id,
                'family_id' => $request->family_id,
            ]);
        }

        HfFamilyMemberOtherCourse::create([
            'family_member_id' => $familyMember->id,
            'course' => $request->course,
        ]);

        HfFamilyMemberHobby::create([
            'family_member_id' => $familyMember->id,
            'hobby' => $request->mem_hobby,
        ]);

        HfFamilyMemberGoal::create([
            'family_member_id' => $familyMember->id,
            'goal' => $request->mem_goal,
        ]);

        HfFamilyMemberSkill::create([
            'family_member_id' => $familyMember->id,
            'skill' => $request->mem_skill,
        ]);


        // All support required for each family member are saved from here onwards

        HfFamilyMemberPrioritySupport::create([
            'family_member_id' => $familyMember->id,
            'priority_support' => $request->priority_support,
        ]);

        HfFamilyMemberOccupationSupport::create([
            'family_member_id' => $familyMember->id,
            'support_source' => $request->sr_support_source,
            'support_received' => $request->sr_support_received,
            'support_required' => $request->sr_support_required,
        ]);

        HfFamilyMemberAcademySupport::create([
            'family_member_id' => $familyMember->id,
            'support_source' => $request->edu_support_source,
            'support_received' => $request->edu_support_received,
            'support_required' => $request->edu_support_required,
        ]);

        HfFamilyMemberOccupationSupport::create([
            'family_member_id' => $familyMember->id,
            'support_source' => $request->hlth_support_source,
            'support_received' => $request->hlth_support_received,
            'support_required' => $request->hlth_support_required,
        ]);





        return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfFamilyMember  $hfFamilyMember
     * @return \Illuminate\Http\Response
     */

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }
    public function show($id)

    {

        $hfFamilyMember = DB::table('hf_family_members')
        ->leftJoin('hf_family_member_academies','hf_family_member_academies.family_member_id','hf_family_members.id')
        ->leftJoin('hf_academic_details','hf_academic_details.id','hf_family_member_academies.academy_detail_id')
        ->leftJoin('hf_family_member_skills','hf_family_member_skills.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_hobbies','hf_family_member_hobbies.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_goals','hf_family_member_goals.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_other_courses','hf_family_member_other_courses.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_rel_majors','hf_family_member_rel_majors.id','hf_academic_details.major')
        ->where('hf_family_members.family_id','=',$id)
        ->where('hf_family_members.occupation_type','=','Student')
        ->where('hf_family_member_academies.type','=','Religious')
        ->get();
        


        
     
        return response()->json($hfFamilyMember);
    }
    public function show2($id)

    {

        $hfFamilyMember2 = DB::table('hf_family_members')
        ->leftJoin('hf_family_member_academies','hf_family_member_academies.family_member_id','hf_family_members.id')
        ->leftJoin('hf_academic_details','hf_academic_details.id','hf_family_member_academies.academy_detail_id')
        ->leftJoin('hf_family_member_skills','hf_family_member_skills.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_hobbies','hf_family_member_hobbies.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_goals','hf_family_member_goals.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_other_courses','hf_family_member_other_courses.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_academy_majors','hf_family_member_academy_majors.id','hf_academic_details.major')
        ->where('hf_family_members.family_id','=',$id)
        ->where('hf_family_members.occupation_type','=','Student')
        ->where('hf_family_member_academies.type','=','General')
        ->get();
        


        
    
        return response()->json($hfFamilyMember2);
    }
    public function dashshow($id)

    {

        $hfFamilyMember = DB::table('hf_family_members')
        ->leftJoin('hf_family_member_academies','hf_family_member_academies.family_member_id','hf_family_members.id')
        ->leftJoin('hf_academic_details','hf_academic_details.id','hf_family_member_academies.academy_detail_id')
        ->leftJoin('hf_family_member_skills','hf_family_member_skills.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_hobbies','hf_family_member_hobbies.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_goals','hf_family_member_goals.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_other_courses','hf_family_member_other_courses.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_rel_majors','hf_family_member_rel_majors.id','hf_academic_details.major')
        ->leftJoin('hf_families','hf_families.id','hf_family_members.family_id')
        ->where('hf_family_members.occupation_type','=','Student')
        ->where('hf_family_member_academies.type','=','Religious')
        ->where('hf_family_member_academies.status','=','Pursuing')
        ->where('hf_families.jamath_id','=',$id)
        ->get();
        


        
     
        return response()->json($hfFamilyMember);
    }
    public function dashshow2($id)

    {

        $hfFamilyMember2 = DB::table('hf_family_members')
        ->leftJoin('hf_family_member_academies','hf_family_member_academies.family_member_id','hf_family_members.id')
        ->leftJoin('hf_academic_details','hf_academic_details.id','hf_family_member_academies.academy_detail_id')
        ->leftJoin('hf_family_member_skills','hf_family_member_skills.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_hobbies','hf_family_member_hobbies.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_goals','hf_family_member_goals.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_other_courses','hf_family_member_other_courses.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_academy_majors','hf_family_member_academy_majors.id','hf_academic_details.major')
        ->leftJoin('hf_families','hf_families.id','hf_family_members.family_id')
        ->where('hf_family_members.occupation_type','=','Student')
        ->where('hf_family_member_academies.type','=','General')
        ->where('hf_family_member_academies.status','=','Pursuing')
        ->where('hf_families.jamath_id','=',$id)
        ->get();
        


        
    
        return response()->json($hfFamilyMember2);
    }







    public function sadashshow()

    {

        $hfFamilyMember = DB::table('hf_family_members')
        ->leftJoin('hf_family_member_academies','hf_family_member_academies.family_member_id','hf_family_members.id')
        ->leftJoin('hf_academic_details','hf_academic_details.id','hf_family_member_academies.academy_detail_id')
        ->leftJoin('hf_family_member_skills','hf_family_member_skills.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_hobbies','hf_family_member_hobbies.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_goals','hf_family_member_goals.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_other_courses','hf_family_member_other_courses.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_rel_majors','hf_family_member_rel_majors.id','hf_academic_details.major')
        ->leftJoin('hf_families','hf_families.id','hf_family_members.family_id')
        ->where('hf_family_members.occupation_type','=','Student')
        ->where('hf_family_member_academies.type','=','Religious')
        ->where('hf_family_member_academies.status','=','Pursuing')
        ->get();
        


        
     
        return response()->json($hfFamilyMember);
    }






    public function sadashshow2()

    {

        $hfFamilyMember2 = DB::table('hf_family_members')
        ->leftJoin('hf_family_member_academies','hf_family_member_academies.family_member_id','hf_family_members.id')
        ->leftJoin('hf_academic_details','hf_academic_details.id','hf_family_member_academies.academy_detail_id')
        ->leftJoin('hf_family_member_skills','hf_family_member_skills.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_hobbies','hf_family_member_hobbies.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_goals','hf_family_member_goals.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_other_courses','hf_family_member_other_courses.family_member_id','hf_family_members.id')
        ->leftJoin('hf_family_member_academy_majors','hf_family_member_academy_majors.id','hf_academic_details.major')
        ->leftJoin('hf_families','hf_families.id','hf_family_members.family_id')
        ->where('hf_family_members.occupation_type','=','Student')
        ->where('hf_family_member_academies.type','=','General')
        ->where('hf_family_member_academies.status','=','Pursuing')
    
        ->get();
        


        
    
        return response()->json($hfFamilyMember2);
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfFamilyMember  $hfFamilyMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfFamilyMember $hfFamilyMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfFamilyMember  $hfFamilyMember
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $role->delete();
        $res=HfFamilyMember::where('id',$id)->delete();
        return response()->json([$id]);
    }

}
