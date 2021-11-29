<?php

namespace App\Http\Controllers;

use App\Models\HfAddress;
use App\Models\HfContact;
use App\Models\HfFamily;
use App\Models\HfFamilyAddress;
use App\Models\HfFamilyBank;
use App\Models\HfFamilyContact;
use App\Models\HfFamilyFood;
use App\Models\HfFamilyLanguage;
use App\Models\HfFamilyMember;
use App\Models\HfShelter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use DB;
class HfFamilyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLastFamilyCode()
    {
        $lastFamily = HfFamily::latest()->first();
        if($lastFamily){
            $familyCode = $lastFamily->family_code;
            $lastFamilyCode = substr($familyCode,2);
        }else{
            $lastFamilyCode = 0;
        }

        return $lastFamilyCode;
    }

    public function getFamilyCode()
    {
        $value = sprintf("HF%03d",1+intval($this->getLastFamilyCode()));
        return $value;
    }

    public function index()
    {
        $families = HfFamily::all();
        $families->map(function($family){
            $family['imgUrl'] = url($family->ration_img_url);
            $family->currentFamilyAddress && $family['street'] = $family->currentFamilyAddress->address->street;
            $family['members'] = $family->familyMember->count();
            return [
                $family,
            ];
        });

        return response()->json($families);
    }

    public function show3($id)
    {
        // $families = HfFamily::where('jamath_id',$id);
        // $families->map(function($family){
        //     $family['imgUrl'] = url($family->ration_img_url);
        //     $family->currentFamilyAddress && $family['street'] = $family->currentFamilyAddress->address->street;
        //     $family['members'] = $family->familyMember->count();
        //     return [
        //         $family,
        //     ];
        // });

        return response()->json("ssjsj");
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request = (object) $request->json()->all();
        // return response($request, 201);
        $address = HfAddress::create([
            'address' => $request->address,
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'pincode' => $request->pincode,
        ]);

        $family = HfFamily::create([
            'family_code' => $this->getFamilyCode(),
            'door_no'=>$request->door,
            'religion'=>$request->religion,
            'ration_card_type'=>$request->ration_card_type,
            'ration_card_no'=>$request->ration_card_no,
            'income'=>$request->income,
            'income_source'=>$request->income_source,
            'user_id'=>$request->user_id,
            'jamath_id'=>$request->jamath_id,

            'language'=>$request->language
        ]);

        $familyAddress = HfFamilyAddress::create([
            'address_id' => $address->id,
            'family_id' => $family->id,
        ]);

        HfShelter::create([
            'ownership' => $request->shelter_ownership,
            'type' => $request->shelter_type,
            'support_required' => $request->shelter_support_required,
            'family_id' => $family->id,
        ]);

        HfFamilyBank::create([
            'account_no' => $request->account_no,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'ifsc_code' => $request->ifsc_code,
            'family_id' => $family->id,
        ]);

        HfFamilyFood::create([
            'family_id' => $family->id,
            'source' => $request->food_source,
            'support_required' => $request->food_support_required,
            'support_req_status' => $request->hsrdd,
        ]);

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
            HfFamilyContact::create([
                'contact_id'=>$contact,
                'family_id'=>$family->id,
            ]);
        }





        

        $path=null;
        if($request->hasFile('ration_img_url')){
            $path = $request->file('ration_img_url')->move('families/rationCardImg/'.$family->id);
        }

        $family->update([
            'family_address_id' => $familyAddress->id,
            'ration_img_url' => $path,
        ]);

        return response()->json($family, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfFamily  $hfFamily
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $hfFamily = HfFamily::where('id', $id)->first();
        $hfFamily['ration_img_url'] = url($hfFamily->ration_img_url);
        $hfFamily['address']=$hfFamily->currentFamilyAddress->address->address;
        $hfFamily['street']=$hfFamily->currentFamilyAddress->address->street;
        $hfFamily['city']=$hfFamily->currentFamilyAddress->address->city;
        $hfFamily['state']=$hfFamily->currentFamilyAddress->address->state;
        $hfFamily['pincode']=$hfFamily->currentFamilyAddress->address->pincode;
        $hfFamily['country']=$hfFamily->currentFamilyAddress->address->country;
        $hfFamily['account_no']=$hfFamily->bank->account_no;
        $hfFamily['type']=$hfFamily->shelter->type;
        $hfFamily['ownership']=$hfFamily->shelter->ownership;
        $hfFamily['religions'] = $hfFamily->hfreligion;
        // $hfFamily['door_no'] = $hfFamily->door;
        

        $hfFamily['bank_name']=$hfFamily->bank->bank_name;
        $hfFamily['bank_branch']=$hfFamily->bank->bank_branch;
        $hfFamily['ifsc_code']=$hfFamily->bank->ifsc_code;
        

        $hfFamily['contacts'] = $hfFamily->familyContact->map(function ($contact){
            return [
                'type'=>$contact->contact->contact_type,
                'value'=>$contact->contact->value
            ];
        });

        return response()->json($hfFamily);
    }
    public function show2($id)
    {
        $hfFamily = DB::table('hf_families')
        ->join('hf_family_banks','hf_family_banks.family_id','hf_families.id')
        // ->join('hf_academic_details','hf_academic_details.id','hf_family_member_academies.academy_detail_id')
        // ->join('hf_family_member_skills','hf_family_member_skills.family_member_id','hf_family_members.id')
        // ->join('hf_family_member_hobbies','hf_family_member_hobbies.family_member_id','hf_family_members.id')
        // ->join('hf_family_member_goals','hf_family_member_goals.family_member_id','hf_family_members.id')
        // ->join('hf_family_member_other_courses','hf_family_member_other_courses.family_member_id','hf_family_members.id')
        // ->join('hf_family_member_rel_majors','hf_family_member_rel_majors.id','hf_academic_details.major')
        // ->join('hf_family_members','hf_family_members.id','hf_family_member_skills.family_member_id')
        // ->join('hf_family_members','hf_family_members.id','hf_family_member_goals.family_member_id')
        ->where('hf_families.id','=',$id)
        // ->where('hf_family_members.occupation_type','=','Student')
        // ->where('hf_family_member_academies.type','=','Religious')
        ->first();
        

        return response()->json($hfFamily);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfFamily  $hfFamily
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfFamily $hfFamily)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfFamily  $hfFamily
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $role->delete();
        $res=HfFamily::where('id',$id)->delete();
        return response()->json([$id]);
    }


}
