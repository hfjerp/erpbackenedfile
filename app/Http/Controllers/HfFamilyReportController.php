<?php

namespace App\Http\Controllers;

use App\Models\HfFamily;
use App\Models\HfFamilyMember;
use App\Models\HfFamilyMemberBank;
use App\Models\HfFamilyMemberAcademy;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class HfFamilyReportController extends Controller
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
        
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfFamily  $family_report
     * @return \Illuminate\Http\Response
     */

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }


    public function show(HfFamily $family_report)
    {
        $hfFamily_id = $family_report->id;
        $allFamilyMembers = HfFamilyMember::where('family_id', $hfFamily_id)->get();
        $males = HfFamilyMember::where([
            'family_id' => $hfFamily_id,
            'gender' => 'Male'
        ])->get()->count();
        $females = HfFamilyMember::where([
            'family_id' => $hfFamily_id,
            'gender' => 'Female'
        ])->get()->count();
        if ($allFamilyMembers) {
            $allFamilyMembers->map(function ($familyMember) {
                $familyMember->occupation_type == "Business Owner" && ($familyMember->occupationDetail);
                $familyMember->occupation_type == "Job" && ($familyMember->occupationDetail);
                $familyMember->occupation_type == "Student" && $familyMember->familyMemberAcademy->map(function ($memberAcademy) {
                    return $memberAcademy->academicDetail;
                });
                $familyMember->familyMemberCourse && $familyMember['other_course'] = $familyMember->familyMemberCourse->course;
                $familyMember['banki'] = $familyMember->banki;
                $familyMember['healthy'] = $familyMember->healthy;
                $familyMember->familyMemberHobby && $familyMember['hobby'] = $familyMember->familyMemberHobby->hobby;
                $familyMember->familyMemberSkill && $familyMember['skill'] = $familyMember->familyMemberSkill->skill;
                $familyMember->familyMemberGoal && $familyMember['goal'] = $familyMember->familyMemberGoal->goal;
                $familyMember->familyMemberAcademySupport && $familyMember['edu_support'] = $familyMember->familyMemberAcademySupport;
                $familyMember->familyMemberOccupationSupport && $familyMember['ocu_support'] = $familyMember->familyMemberOccupationSupport;
                $familyMember->familyMemberHealtDetail && $familyMember['health'] = $familyMember->familyMemberHealtDetail;
                // $familyMember['health']['since']= Carbon::parse($familyMember->familyMemberHealtDetail->since->age);
                $familyMember->familyMemberHealtSupport && $familyMember['health_support'] = $familyMember->familyMemberHealtSupport;
                $familyMember->familyMemberPrioritySupport && $familyMember['priority_support'] = $familyMember->familyMemberPrioritySupport->priority_support;
                $tempRelEdu = HfFamilyMemberAcademy::where(['family_member_id' => $familyMember->id, 'type' => "Religious"])->first();
                if($tempRelEdu){
                    $familyMember['religious_edu'] = $tempRelEdu;
                    $familyMember['religious_edu']['academic_year'] = Carbon::parse($tempRelEdu->academicDetail->academic_year)->format('Y');
                }
                $tempGenEdu = HfFamilyMemberAcademy::where(['family_member_id' => $familyMember->id, 'type' => "General"])->first();
                if($tempGenEdu){
                    $familyMember['general_edu'] = $tempGenEdu;
                    $familyMember['general_edu']['academic_year'] = Carbon::parse($tempGenEdu->academicDetail->academic_year)->format('Y');
                }

                $familyMember->aadhar && $familyMember->aadhar['aadhar_card_img_url'] = url($familyMember->aadhar->aadhar_card_img_url);
                $familyMember->voterId && $familyMember->voterId['voter_id_card_img_url'] = url($familyMember->voterId->voter_id_card_img_url);
                $familyMember->health && $familyMember->health['health_card_img_url'] = url($familyMember->health->health_card_img_url);
                $familyMember->profile_img_url && $familyMember['profile_img_url'] = url($familyMember->profile_img_url);
                $familyMember->labour && $familyMember->labour['labour_card_img_url'] = url($familyMember->labour->labour_card_img_url);
                $familyMember->seniorCitizen && $familyMember->seniorCitizen['senior_citizen_card_img_url'] = url($familyMember->seniorCitizen->senior_citizen_card_img_url);
                $familyMember->profile_img_url && $familyMember['profile_img_url'] = url($familyMember->profile_img_url);
                $familyMember->familyMemberContact;
                $familyMember['age'] = Carbon::parse($familyMember->dob)->age;
                $familyMember->familyMemberContact && $familyMember->familyMemberContact->map(function ($memberContact) {
                    return $memberContact->contact;
                });
                // $familyMember['bank'] = $familyMember->bank['passbook_url'] = url($familyMember->bank->passbook_url);
                if ($familyMember->familyHead) {
                    $familyMember['isHead'] = true;
                    return [
                        'familyHead' => $familyMember,
                    ];
                }

                $familyMember['isHead'] = false;
                return [
                    'familyMember' => $familyMember,
                ];
            });
            $family_report['males'] = $males;
            $family_report['females'] = $females;
            $family_report['total_members'] = $allFamilyMembers->count();
            $family_report['religions'] = $family_report->hfreligion;
            $family_report['marit'] = $family_report->hfmaritial;
            $family_report['food'] = $family_report->food;
            $family_report['shelter'] = $family_report->shelter;
            $family_report['bank'] = $family_report->bank;
            // $family_report['banki'] = $HfFamilyMember->banki;
            $family_report['contacts'] = $family_report->familyContact->map(function ($contact) {
                if ($contact->contact->contact_type == "Contact No.") {
                    $contact['phone'] = $contact->contact->value;
                    return $contact;
                }
                $contact['email'] = $contact->contact->value;
                return $contact;
            });
            $family_report['address'] = $family_report->familyAddress->map(function ($address) {
                return $address->address;
            });
            $family_report['allFamilyMembers'] = $allFamilyMembers;
            return response()->json($family_report);
        }

        return response()->json(['msg' => "No family Members are registered."], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfFamily  $family_report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfFamily $family_report)
    {
        //
    }

    public function showjamath($id)
    {
       $jam = DB::table("hf_jamaths")
       ->where('id','=',$id)
       ->get();


       return response()->json([
           'jam'=> $jam
        ]);



        
    }
     public function jamtal($id)
    {
        $jamtal = DB::table("hf_jamaths")
       ->join('hf_taluks','hf_taluks.id','hf_jamaths.taluk_id')
       ->where('hf_jamaths.id','=',$id)
       ->get();


       return response()->json([
           'jamtal'=> $jamtal
        ]);



        
    } 
    
    public function jamtaldis($id)
    {
        $jamtaldis = DB::table("hf_jamaths")
       ->join('hf_taluks','hf_taluks.id','hf_jamaths.taluk_id')
       ->join('hf_districts','hf_districts.id','hf_taluks.district_id')

       ->where('hf_jamaths.id','=',$id)
       ->get();


       return response()->json([
           'jamtaldis'=> $jamtaldis
        ]);



        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfFamily  $family_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfFamily $family_report)
    {
        //
    }
}
