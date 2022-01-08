<?php

namespace App\Http\Controllers;

use App\Models\HfAcademicDetail;
use App\Models\HfContact;
use App\Models\HfFamilyHead;
use App\Models\HfFamilyMember;
use App\Models\HfFamilyMemberAadhar;
use App\Models\HfFamilyMemberAcademy;
use App\Models\HfFamilyMemberAcademySupport;
use App\Models\HfFamilyMemberHealthSupport;
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

class HfFamilyMemberController extends Controller
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
        $adhexist = HfFamilyMemberAadhar::where('aadhar_card_no',$request->aadhar_card_no)->get();
    
        

        if(count($adhexist) > 0){
            $res=HfFamilyMember::where('id',$adhexist->family_member_id)->get();
            return response()->json([
                'res' => $adhexist,
                'res1'  => $res,
                'status' => 205
            ]);
        }else{
        $familyMember = HfFamilyMember::create([
            'name' => $request->name,
            'family_id' => $request->family_id,
            'blood_group' => $request->blood_group,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'occupation_type' => $request->occupation_type,
            'relationship' => $request->relationship=="Other"?$request->extra_rel:$request->relationship,
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
                'other' => $request->other,
            ]);
        }

        if($request->gen_education_type) {
            $academyDetail = HfAcademicDetail::create([
                'academic_year' => $request->academic_year,
                'major' => $request->major,
                'class' => $request->academy_class,
                'academy_name' => $request->academy_name,
                'scourse' => $request->subject,
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
                'academic_year' => $request->rel_academic_year,
                'major' => $request->rel_major,
                'class' => $request->rel_academy_class,
                'academy_name' => $request->rel_academy_name,
                'academic_medium' => $request->rel_medium,
            ]);

            HfFamilyMemberAcademy::create([
                "family_member_id" => $familyMember->id,
                "academy_detail_id" => $academyDetail->id,
                'status' => $request->gen_status,
                'type' => $request->rel_education_type,

                "current_academy" => $academyDetail->id,
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
            'description' => $request->health_status,
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
            'support_req_status' => $request->ooooo,
        ]);

        HfFamilyMemberAcademySupport::create([
            'family_member_id' => $familyMember->id,
            'support_source' => $request->edu_support_source,
            'support_received' => $request->edu_support_received,
            'support_required' => $request->edu_support_required,
            'support_req_status' => $request->kkkk,
        ]);

        HfFamilyMemberHealthSupport::create([
            'family_member_id' => $familyMember->id,
            'support_source' => $request->hlth_support_source,
            'support_received' => $request->hlth_support_received,
            'support_required' => $request->hlth_support_required,
            'support_req_status' => $request->hsrd,
        ]);





        return response()->json($request);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfFamilyMember  $hfFamilyMember
     * @return \Illuminate\Http\Response
     */

    // public function getAgeAttribute()
    // {
    //     return Carbon::parse($this->attributes['birthdate'])->age;
    // }
    public function show(HfFamilyMember $hfFamilyMember, $id)

    {
        $hfFamilyMember=HfFamilyMember::find($id);
        
        $hfFamilyMember = HfFamilyMember::where('family_id', $id)->get();
        // $hfFamilyMember['age'] = Carbon::parse($hfFamilyMember->dob)->age;
        // $hfFamilyMember['profile_img_url'] = url($hfFamilyMember->profile_img_url);
        // $hfFamilyMember['name']=$hfFamilyMember->name;
        // $hfFamily['street']=$hfFamily->currentFamilyAddress->address->street;
        // $hfFamily['city']=$hfFamily->currentFamilyAddress->address->city;
        // $hfFamily['state']=$hfFamily->currentFamilyAddress->address->state;
        // $hfFamily['pincode']=$hfFamily->currentFamilyAddress->address->pincode;
        // $hfFamily['country']=$hfFamily->currentFamilyAddress->address->country;
        // $hfFamily['account_no']=$hfFamily->bank->account_no;
        // $hfFamily['bank_name']=$hfFamily->bank->bank_name;
        // $hfFamily['bank_branch']=$hfFamily->bank->bank_branch;
        // $hfFamily['ifsc_code']=$hfFamily->bank->ifsc_code;
        

        // $hfFamily['contacts'] = $hfFamily->familyContact->map(function ($contact){
        //     return [
        //         'type'=>$contact->contact->contact_type,
        //         'value'=>$contact->contact->value
        //     ];
        // });

        return response()->json($hfFamilyMember);
    }

    public function DashMemList($id)

    {
 
        
        $exe=DB:: table('hf_family_members')

        ->join('hf_families','hf_families.id','hf_family_members.family_id')
        ->select('hf_family_members.id as memid','hf_families.*','hf_family_members.*')

        ->where('hf_families.jamath_id','=',$id)
        ->get();
        return response()->json($exe);
    }

    public function DashMemListMR($id)

    {
 
        
        $exe=DB:: table('hf_family_members')

        ->join('hf_families','hf_families.id','hf_family_members.family_id')
        ->select('hf_family_members.id as memid','hf_families.*','hf_family_members.*')

        ->where('hf_families.user_id','=','mradmin')
        ->get();
        return response()->json($exe);
    }


    public function DashMemListGC($id)

    {
 
        
        $exe=DB:: table('hf_family_members')

        ->join('hf_families','hf_families.id','hf_family_members.family_id')
        ->select('hf_family_members.id as memid','hf_families.*','hf_family_members.*')

        ->where('hf_families.user_id','=','gcadmin')
        ->get();
        return response()->json($exe);
    }


    public function SADashMemList()

    {
 
        
        $exe=DB:: table('hf_family_members')

        ->LeftJoin('hf_families','hf_families.id','hf_family_members.family_id')
        ->LeftJoin('hf_jamaths','hf_jamaths.id','hf_families.jamath_id')
        ->LeftJoin('hf_taluks','hf_taluks.id','hf_jamaths.taluk_id')
        ->LeftJoin('hf_districts','hf_districts.id','hf_taluks.district_id')
        ->LeftJoin('hf_states','hf_states.id','hf_districts.state_id')
        ->select('hf_family_members.id as memid','hf_family_members.name as memname','hf_families.*','hf_family_members.*','hf_jamaths.*','hf_taluks.*','hf_districts.*','hf_states.*')
        ->get();
        return response()->json($exe);
    }




    public function SADashMemhealthlist()

    {
 
        
        $exe=DB:: table('hf_family_members')

        ->LeftJoin('hf_families','hf_families.id','hf_family_members.family_id')
        ->LeftJoin('hf_jamaths','hf_jamaths.id','hf_families.jamath_id')
        ->LeftJoin('hf_taluks','hf_taluks.id','hf_jamaths.taluk_id')
        ->LeftJoin('hf_districts','hf_districts.id','hf_taluks.district_id')
        ->LeftJoin('hf_states','hf_states.id','hf_districts.state_id')
        ->LeftJoin('hf_family_member_health_supports','hf_family_member_health_supports.family_member_id','hf_family_members.id')

        ->select('hf_family_members.id as memid','hf_family_members.name as memname','hf_families.*','hf_family_members.*','hf_jamaths.*','hf_taluks.*','hf_districts.*','hf_states.*','hf_family_member_health_supports.*')
        ->where('hf_family_member_health_supports.support_req_status',"=",'Yes')
        ->get();
        return response()->json($exe);
    }
    public function SADashMemocclist()

    {
 
        
        $exe=DB:: table('hf_family_members')

        ->LeftJoin('hf_families','hf_families.id','hf_family_members.family_id')
        ->LeftJoin('hf_jamaths','hf_jamaths.id','hf_families.jamath_id')
        ->LeftJoin('hf_taluks','hf_taluks.id','hf_jamaths.taluk_id')
        ->LeftJoin('hf_districts','hf_districts.id','hf_taluks.district_id')
        ->LeftJoin('hf_states','hf_states.id','hf_districts.state_id')
        ->LeftJoin('hf_family_member_occupation_supports','hf_family_member_occupation_supports.family_member_id','hf_family_members.id')

        ->select('hf_family_members.id as memid','hf_family_members.name as memname','hf_families.*','hf_family_members.*','hf_jamaths.*','hf_taluks.*','hf_districts.*','hf_states.*','hf_family_member_occupation_supports.*')
        ->where('hf_family_member_occupation_supports.support_req_status',"=",'Yes')
        ->get();
        return response()->json($exe);
    }
    public function SADashMemacalist()

    {
 
        
        $exe=DB:: table('hf_family_members')

        ->LeftJoin('hf_families','hf_families.id','hf_family_members.family_id')
        ->LeftJoin('hf_jamaths','hf_jamaths.id','hf_families.jamath_id')
        ->LeftJoin('hf_taluks','hf_taluks.id','hf_jamaths.taluk_id')
        ->LeftJoin('hf_districts','hf_districts.id','hf_taluks.district_id')
        ->LeftJoin('hf_states','hf_states.id','hf_districts.state_id')
        ->LeftJoin('hf_family_member_academy_supports','hf_family_member_academy_supports.family_member_id','hf_family_members.id')

        ->select('hf_family_members.id as memid','hf_family_members.name as memname','hf_families.*','hf_family_members.*','hf_jamaths.*','hf_taluks.*','hf_districts.*','hf_states.*','hf_family_member_academy_supports.*')
        ->where('hf_family_member_academy_supports.support_req_status',"=",'Yes')
        ->get();
        return response()->json($exe);
    }


    // public function edit($id)

    // {
    //     // $hfFamilyMember=HfFamilyMember::find($id);
        
    //     $hfFamilyMember = HfFamilyMember::where('family_id', $id)->get();
    //     $hfFamilyMember->map(function ($fam){
    //     $fam['banki'] = $fam->banki;

        


    //     });

    public function edit($id)

    {
        $hfFamilymem = DB::table('hf_family_members')
        ->LeftJoin('hf_family_member_health_details','hf_family_member_health_details.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_family_member_health_supports','hf_family_member_health_supports.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_occupation_details','hf_occupation_details.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_family_member_occupation_supports','hf_family_member_occupation_supports.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_family_member_academies','hf_family_member_academies.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_academic_details','hf_academic_details.id','hf_family_member_academies.academy_detail_id')
        ->LeftJoin('hf_family_member_skills','hf_family_member_skills.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_family_member_hobbies','hf_family_member_hobbies.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_family_member_goals','hf_family_member_goals.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_family_member_other_courses','hf_family_member_other_courses.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_family_member_academy_supports','hf_family_member_academy_supports.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_family_member_aadhars','hf_family_member_aadhars.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_family_member_voter_ids','hf_family_member_voter_ids.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_family_member_banks','hf_family_member_banks.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_family_member_healths','hf_family_member_healths.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_family_member_senior_citizens','hf_family_member_senior_citizens.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_family_member_labours','hf_family_member_labours.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_family_member_priority_supports','hf_family_member_priority_supports.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_family_member_contacts','hf_family_member_contacts.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_contacts','hf_contacts.id','hf_family_member_contacts.contact_id')
        ->LeftJoin('hf_family_heads','hf_family_heads.family_member_id','hf_family_members.id')
 
        ->select('hf_family_member_occupation_supports.support_required as osrq','hf_family_heads.id as head','hf_family_member_occupation_supports.support_received as osrc','hf_family_member_occupation_supports.support_source as oss','hf_family_member_health_supports.support_required as hsrq','hf_family_member_health_supports.support_received as hsrc','hf_family_member_health_supports.support_source as hss','hf_family_member_academy_supports.support_required as asrq','hf_family_member_academy_supports.support_received as asrc','hf_family_member_academy_supports.support_source as ass','hf_family_member_occupation_supports.*','hf_family_member_health_details.*','hf_family_member_health_supports.*','hf_occupation_details.*','hf_family_member_occupation_supports.*','hf_family_members.*','hf_family_member_academies.*','hf_academic_details.*','hf_family_member_skills.*','hf_family_member_hobbies.*','hf_family_member_goals.*','hf_family_member_other_courses.*','hf_family_member_academy_supports.*','hf_family_member_aadhars.*','hf_family_member_voter_ids.*','hf_family_member_banks.*','hf_family_member_healths.*','hf_family_member_senior_citizens.*','hf_family_member_labours.*','hf_family_member_priority_supports.*','hf_family_member_contacts.*','hf_contacts.*','hf_family_heads.*')
           

        ->where('hf_family_members.id','=',$id)
        ->get();
        
        return response()->json($hfFamilymem);
    }



    public function updatememform(Request $request)
    {

        $familyMember=HfFamilyMember::where("id",$request['ID'])->first();
        // $academyDetail=HfAcademicDetail::where("family_memeber_id",$request['ID'])->firstOrFail();
        // $HfFamilyMemberAcademy=HfFamilyMemberAcademy::where("family_memeber_id",$request['ID'])->firstOrFail();
        $HfOccupationDetail=HfOccupationDetail::where("family_member_id",$request['ID'])->firstOrFail();
        $HfFamilyMemberAadhar=HfFamilyMemberAadhar::where("family_member_id",$request['ID'])->firstOrFail();
        $HfFamilyMemberSeniorCitizen=HfFamilyMemberSeniorCitizen::where("family_member_id",$request['ID'])->firstOrFail();
        $HfFamilyMemberLabour=HfFamilyMemberLabour::where("family_member_id",$request['ID'])->firstOrFail();
        $HfFamilyMemberHealth=HfFamilyMemberHealth::where("family_member_id",$request['ID'])->firstOrFail();
        $HfFamilyMemberBank=HfFamilyMemberBank::where("family_member_id",$request['ID'])->firstOrFail();
        $HfFamilyMemberVoterId=HfFamilyMemberVoterId::where("family_member_id",$request['ID'])->firstOrFail();
        $HfFamilyMemberHealthDetail=HfFamilyMemberHealthDetail::where("family_member_id",$request['ID'])->firstOrFail();
        $HfFamilyMemberPrioritySupport=HfFamilyMemberPrioritySupport::where("family_member_id",$request['ID'])->firstOrFail();
        $HfFamilyMemberOccupationSupport=HfFamilyMemberOccupationSupport::where("family_member_id",$request['ID'])->firstOrFail();
        $HfFamilyMemberAcademySupport=HfFamilyMemberAcademySupport::where("family_member_id",$request['ID'])->firstOrFail();
        $HfFamilyMemberHealthSupport=HfFamilyMemberHealthSupport::where("family_member_id",$request['ID'])->firstOrFail();
        $HfFamilyMemberHobby=HfFamilyMemberHobby::where("family_member_id",$request['ID'])->firstOrFail();
        $HfFamilyMemberGoal=HfFamilyMemberGoal::where("family_member_id",$request['ID'])->firstOrFail();
        $HfFamilyMemberSkill=HfFamilyMemberSkill::where("family_member_id",$request['ID'])->firstOrFail();
        $HfFamilyMemberOtherCourse=HfFamilyMemberOtherCourse::where("family_member_id",$request['ID'])->firstOrFail();
        // $HfFamilyHead=HfFamilyHead::where("family_member_id",$request['ID'])->firstOrFail();
        $academyDetail= DB::table('hf_family_members')
        ->LeftJoin('hf_family_member_academies','hf_family_member_academies.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_academic_details','hf_academic_details.id','hf_family_member_academies.academy_detail_id')
        ->where('hf_family_member_academies.type','=','Religious')
        ->where('hf_family_members.id','=',$request['ID']);
        $academyDetail2= DB::table('hf_family_members')
        ->LeftJoin('hf_family_member_academies','hf_family_member_academies.family_member_id','hf_family_members.id')
        ->LeftJoin('hf_academic_details','hf_academic_details.id','hf_family_member_academies.academy_detail_id')
        ->where('hf_family_member_academies.type','=','General')
        ->where('hf_family_members.id','=',$request['ID']);
        $cont= DB::table('hf_family_members')
        ->join('hf_family_member_contacts','hf_family_member_contacts.family_member_id','hf_family_members.id')
        ->join('hf_contacts','hf_contacts.id','hf_family_member_contacts.contact_id');

       
        // ->select('hf_shelters.support_required as change','hf_families.*','hf_family_banks.*','hf_family_food.*','hf_shelters.*','hf_family_addresses.*','hf_addresses.*')
        // ->select('hf_family_food.support_required as chhanged','hf_families.*','hf_family_banks.*','hf_family_food.*','hf_shelters.*','hf_family_addresses.*','hf_addresses.*');

        // return $request;
        $familyMember->update([
            'name' => $request->name,
            // 'family_id' => $request->family_id,
            'blood_group' => $request->blood_group,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'occupation_type' => $request->occupation_type,
            'relationship' => $request->relationship=="Other"?$request->extra_rel:$request->relationship,
        ]);
            // --------------------------------_____
            $contact_list = [];

        // $data = $request->contacts;
        // return response($data);

        $tempArray = json_decode($request->contacts, true);
        foreach ((array)$tempArray as $contact) {
            $contct = HfContact::create([
                'contact_type' => $contact['type']['name'],
                'value' => $contact['value'],
            ]);
            array_push($contact_list, $contct->id);
        }

            // return response($contact_list);


        foreach ($contact_list as $contact) {
            HfFamilyMemberContact::create([
                'contact_id'=>$contact,
                'family_member_id'=>$familyMember->id,
            ]);
        }
        $contact_list = [];

        // $data = $request->contacts;
        // return response($data);

        $demoArray = json_decode($request->update, true);
        foreach ((array)$demoArray as $contact) {
            $update=HfContact::where('id',$contact['id'])->update([
                
                'value' => $contact['value'],
            ]);
           
        }
        // // ---------------
        // $contact_list = [];

        // $tempArray = json_decode($request->contacts, true);
        // foreach ((array)$tempArray as $contact) {
        //     $contct = HfContact::create([
        //         'contact_type' => $contact['type']['name'],
        //         'value' => $contact['value'],
        //     ]);
        //     array_push($contact_list, $contct->id);
        // }

        // foreach ($contact_list as $contact) {
        //     HfFamilyMemberContact::create([
        //         'contact_id'=>$contact,
        //         'family_member_id'=>$familyMember->id,
        //     ]);
        // }
        // -------------
        if($request->occupation_type == "Business Owner" || "Job"){
            $HfOccupationDetail->update([
                // 'family_member_id' => $familyMember->id,
                'occupation' => $request->occupation_type,
                'workplace_name' => $request->work_place_name,
                'workplace_address' => $request->work_place_address,
                'income' => $request->income,
                'other' => $request->other,
            ]);
        }

        if($request->gen_education_type) {
            $academyDetail2->update([
                'academic_year' => $request->academic_year,
                'major' => $request->major,
                'class' => $request->academy_class,
                'academy_name' => $request->academy_name,
                'academic_medium' => $request->medium,
            ]);

            $academyDetail2->update([
                // "family_member_id" => $familyMember->id,
                // "academy_detail_id" => $academyDetail->id,
                // "current_academy" => $academyDetail->id,
                'status' => $request->gen_status,
                'type' => $request->gen_education_type,


            ]);
    
        }

        if($request->rel_education_type) {
            $academyDetail->update([
                'academic_year' => $request->rel_academic_year,
                'major' => $request->rel_major,
                'class' => $request->rel_academy_class,
                'academy_name' => $request->rel_academy_name,
                'academic_medium' => $request->rel_medium,
            ]);

            $academyDetail->update([
                // "family_member_id" => $familyMember->id,
                // "academy_detail_id" => $academyDetail->id,
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
        // // ---------Aadhar ---------------------
        $aadharCardImgPath = null;

        if($request->file('aadhar_card_img_url')){
            $aadharCardImgPath = $request->file('aadhar_card_img_url')->move('familyMember/' . $familyMember->id . '/aadharCardImg/');
            $HfFamilyMemberAadhar->update([
                'aadhar_card_img_url' =>$aadharCardImgPath,

            ]);
        }

        $HfFamilyMemberAadhar->update([
            'aadhar_card_no'=> $request->aadhar_card_no,
            // 'aadhar_card_img_url'=> $aadharCardImgPath,
            'family_member_id' => $familyMember->id
        ]);

        // ---------- Voter Id ---------------
        $voterIdCardImgPath = null;

        if ($request->file('voter_id_card_img_url')) {
            $voterIdCardImgPath = $request->file('voter_id_card_img_url')->move('familyMember/' . $familyMember->id . '/voterIdCardImg/');
            $HfFamilyMemberVoterId->update([
                'voter_id_card_img_url' =>$voterIdCardImgPath,

            ]);
        }

        $HfFamilyMemberVoterId->update([
            'voter_id_card_no' => $request->voter_id_no,
            // 'voter_id_card_img_url' => $voterIdCardImgPath,
            'family_member_id' => $familyMember->id
        ]);

        // // ---------- Bank Detail ---------------
        $passbookPath = null;
        if ($request->file('passbook_url')) {
            $passbookPath = $request->file('passbook_url')->move('familyMember/' . $familyMember->id . '/passbook/');
            $HfFamilyMemberBank->update([
                'passbook_url' =>$passbookPath,

            ]);
        }

        $HfFamilyMemberBank->update([
            'account_no' => $request->account_number,
            // 'passbook_url' => $passbookPath,
            'family_member_id' => $familyMember->id
        ]);

        // // ---------- Health Card ---------------
        $healthImgPath = null;
        if ($request->file('health_card_img_url')) {
            $healthImgPath = $request->file('health_card_img_url')->move('familyMember/' . $familyMember->id . '/healthCardImg/');
            $HfFamilyMemberHealth->update([
                'health_card_img_url' =>$healthImgPath,

            ]);
        }

        $HfFamilyMemberHealth->update([
            'health_card_no' => $request->health_card_no,
            // 'health_card_img_url' => $healthImgPath,
            'family_member_id' => $familyMember->id
        ]);

        // // ---------- Labour Card ---------------
        $labourImgPath = null;
        if ($request->file('labour_card_img_url')) {
            $labourImgPath = $request->file('labour_card_img_url')->move('familyMember/' . $familyMember->id . '/labourCardImg/');
            $HfFamilyMemberLabour->update([
                'labour_card_img_url' =>$labourImgPath,

            ]);
        }

        $HfFamilyMemberLabour->update([
            'labour_card_no' => $request->labour_card_no,
            // 'labour_card_img_url' => $labourImgPath,
            'family_member_id' => $familyMember->id
        ]);

        // // ---------- Senior Card ---------------
        $sCitizenImgPath = null;
        if ($request->file('senior_citizen_card_img_url')) {
            $sCitizenImgPath = $request->file('senior_citizen_card_img_url')->move('familyMember/' . $familyMember->id . '/sCitizenCardImg/');
            $HfFamilyMemberSeniorCitizen->update([
                'senior_citizen_card_img_url' =>$sCitizenImgPath,

            ]);
        }

        $HfFamilyMemberSeniorCitizen->update([
            'senior_citizen_card_no' => $request->senior_citizen_card_no,
            // 'senior_citizen_card_img_url' => $sCitizenImgPath,
            'family_member_id' => $familyMember->id
        ]);

        // // saving the family member health details
        $HfFamilyMemberHealthDetail->update([
            'family_member_id' => $familyMember->id,
            'disease' => $request->disease,
            'since' => $request->since,
            'description' => $request->health_status,
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
        else{

            HfFamilyHead::where('family_member_id', $familyMember->id) ->delete([
               
            ]);
        }

        $HfFamilyMemberOtherCourse->update([
            'family_member_id' => $familyMember->id,
            'course' => $request->course,
        ]);

        $HfFamilyMemberHobby->update([
            'family_member_id' => $familyMember->id,
            'hobby' => $request->mem_hobby,
        ]);

        $HfFamilyMemberGoal->update([
            'family_member_id' => $familyMember->id,
            'goal' => $request->mem_goal,
        ]);

        $HfFamilyMemberSkill->update([
            'family_member_id' => $familyMember->id,
            'skill' => $request->mem_skill,
        ]);


        // // All support required for each family member are saved from here onwards

        $HfFamilyMemberPrioritySupport->update([
            'family_member_id' => $familyMember->id,
            'priority_support' => $request->priority_support,
        ]);

        $HfFamilyMemberOccupationSupport->update([
            'family_member_id' => $familyMember->id,
            'support_source' => $request->sr_support_source,
            'support_received' => $request->sr_support_received,
            'support_required' => $request->sr_support_required,
            'support_req_status' => $request->ooooo,
        ]);

        $HfFamilyMemberAcademySupport->update([
            'family_member_id' => $familyMember->id,
            'support_source' => $request->edu_support_source,
            'support_received' => $request->edu_support_received,
            'support_required' => $request->edu_support_required,
            'support_req_status' => $request->kkkk,
        ]);

        $HfFamilyMemberHealthSupport->update([
            'family_member_id' => $familyMember->id,
            'support_source' => $request->hlth_support_source,
            'support_received' => $request->hlth_support_received,
            'support_required' => $request->hlth_support_required,
            'support_req_status' => $request->hsrd,
        ]);
        






        return response()->json([
            
            
            'familyMember' =>$familyMember,
            'id' =>$request['gen_education_type'],
        
        ]);
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
