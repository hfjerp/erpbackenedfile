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

class UpdateFamilyController extends Controller
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
     * Store a newly updated resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showjamfam($id)
    {
        $families = HfFamily::where('jamath_id',$id)->get();
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
        $families = HfFamily::where('jamath_id',$id)->get();
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
     public function bplshow($id)
    {
        $families = HfFamily::where('jamath_id',$id)
        ->where('ration_card_type','=','BPL')
        
        ->get();
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


    public function sabplshow()
    {
        $families = HfFamily::where('ration_card_type','=','BPL')->get();
        
       

        return response()->json($families);
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfTalukAdmin  $hfTalukAdmin
     * @return \Illuminate\Http\Response
     */
    public function show2($id)
    {
        $hfFamily = DB::table('hf_families')
        ->join('hf_family_banks','hf_family_banks.family_id','hf_families.id')
        ->join('hf_family_food','hf_family_food.family_id','hf_families.id')
        ->join('hf_shelters','hf_shelters.family_id','hf_families.id')
        ->join('hf_family_addresses','hf_family_addresses.family_id','hf_families.id')
        ->join('hf_addresses','hf_addresses.id','hf_family_addresses.address_id')

        // ->join('hf_family_addresses','hf_family_addresses.family_id','hf_families.id')
        





        ->select('hf_shelters.support_required as change','hf_families.*','hf_family_banks.*','hf_family_food.*','hf_shelters.*','hf_family_addresses.*','hf_addresses.*')
        ->select('hf_family_food.support_required as chhanged','hf_families.*','hf_family_banks.*','hf_family_food.*','hf_shelters.*','hf_family_addresses.*','hf_addresses.*')


        // ->join('hf_family_addresses','hf_family_addresses.address_id','hf_addresses.id')
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
        ->get();
        

        // return response()->json($hfFamily);
        return response()->json([$hfFamily]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfTalukAdmin  $hfTalukAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $family=HfFamily::where("id",$request['ID'])->get();
        // $shelter=HfShelter::where("family_id",$id)->firstOrFail();
        // $bank=HfFamilyBank::where("family_id",$id)->firstOrFail();
        // $food=HfFamilyFood::where("family_id",$id)->firstOrFail();
        // $address= DB::table('hf_families')
        // ->join('hf_family_addresses','hf_family_addresses.family_id','hf_families.id')
        // ->join('hf_addresses','hf_addresses.id','hf_family_addresses.address_id');

        // $contact=HfFamilyContact::where("family_id",$id)->firstOrFail();
        // $address=HfAddress::where("family_id",$id)->firstOrFail();
        // $address->update([
        //     'address' => $request->address,
        //     'street' => $request->street,
        //     'city' => $request->city,
        //     'state' => $request->state,
        //     'country' => $request->country,
        //     'pincode' => $request->pincode,
        // ]);


        $family->update([
            // 'family_code' => $this->getFamilyCode(),
            'name'=>$request['name'],
            // 'religion'=>$request->religion,
            // 'ration_card_type'=>$request->ration_card_type,
            // 'ration_card_no'=>$request->ration_card_no,
            // 'income'=>$request->income,
            // 'income_source'=>$request->income_source,
            // 'user_id'=>$request->user_id,
            // 'language'=>$request->language
        ]);

        // $familyAddress = HfFamilyAddress::update([
        //     'address_id' => $address->id,
        //     'family_id' => $family->id,
        // ]);

        // $shelter->update([
        //     'ownership' => $request->ownership,
        //     'type' => $request->type,
        //     'support_required' => $request->support_required,
        //     'family_id' => $family->id,
        // ]);

        // $bank->update([
        //     'account_no' => $request->account_no,
        //     'bank_name' => $request->bank_name,
        //     'bank_branch' => $request->bank_branch,
        //     'ifsc_code' => $request->ifsc_code,
        //     'family_id' => $family->id,
        // ]);

        // $food->update([
        //     'family_id' => $family->id,
        //     'source' => $request->source,
        //     'support_required' => $request->chhanged,
        // ]);



        // $contact_list = [];

        // // $data = $request->contacts;
        // // return response($data);

        // $tempArray = json_decode($request->contacts, true);
        // foreach ((array)$tempArray as $contact) {
        //     $contct = HfContact::update([
        //         'contact_type' => $contact['type']['name'],
        //         'value' => $contact['value'],
        //     ]);
        //     array_push($contact_list, $contct->id);
        // }

        //     // return response($contact_list);


        // foreach ($contact_list as $contact) {
        //     $contact->update([
        //         'contact_id'=>$contact,
        //         'family_id'=>$family->id,
        //     ]);
        // }




        //     $path='null';
        // if($request->has('ration_img_url')){
        //     $path = $request->file('ration_img_url')->move('families/rationCardImg/'.$family->id);
        // }

        // $family->update([
        //     // 'family_address_id' => $familyAddress->id,
        //     'ration_img_url' => $path,
        // ]);

        return response()->json($family, 200);
    }
    public function FamUpdate(Request $request)
    {
        $family=HfFamily::where("id",$request['ID'])->first();
        $shelter=HfShelter::where("family_id",$request['ID'])->firstOrFail();
        $bank=HfFamilyBank::where("family_id",$request['ID'])->firstOrFail();
        $food=HfFamilyFood::where("family_id",$request['ID'])->firstOrFail();
        $address= DB::table('hf_families')
        ->join('hf_family_addresses','hf_family_addresses.family_id','hf_families.id')
        ->join('hf_addresses','hf_addresses.id','hf_family_addresses.address_id')
       
        ->select('hf_shelters.support_required as change','hf_families.*','hf_family_banks.*','hf_family_food.*','hf_shelters.*','hf_family_addresses.*','hf_addresses.*')
        ->select('hf_family_food.support_required as chhanged','hf_families.*','hf_family_banks.*','hf_family_food.*','hf_shelters.*','hf_family_addresses.*','hf_addresses.*');
        $cont= DB::table('hf_families')
        ->join('hf_family_contacts','hf_family_contacts.family_id','hf_families.id')
        ->join('hf_contacts','hf_contacts.id','hf_family_contacts.contact_id');

         $family->update([
            // 'family_code' => $this->getFamilyCode(),
            'door_no'=>$request['door'],
            'religion'=>$request->religion,
            'ration_card_type'=>$request->ration_card_type,
            'ration_card_no'=>$request->ration_card_no,
            'income'=>$request->income,
            'income_source'=>$request->income_source,
            'user_id'=>$request->user_id,
            'language'=>$request->language
        ]);
        $address->update([
                'address' => $request->address,
                'street' => $request->street,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pincode' => $request->pincode,
            ]);

        //      $contact_list = [];

        // // $data = $request->contacts;
        // // return response($data);

        // $tempArray = json_decode($request->contacts, true);
        // foreach ((array)$tempArray as $contact) {
        //     $cont->create([
        //         // 'contact_type' => $contact['type']['name'],
        //         'value' => $contact['value'],
        //     ]);
        //     array_push($contact_list, $cont->id);
        // }

        //     // return response($contact_list);


        // foreach ($contact_list as $contact) {
        //     $contact->update([
        //         'contact_id'=>$contact,
        //         'family_id'=>$family->id,
        //     ]);
        // }
//-----------update--------------------------
// $contact_list = [];

//         $tempArray = json_decode($request->contacts, true);
//         foreach ((array)$tempArray as $contact) {
//              $contct = HfContact::update([
//                 'contact_type' => $contact['type']['name'],
//                 'value' => $contact['value'],
//             ]);
//             array_push($contact_list, $contct->id);
//         }

//             // return response($contact_list);


//         foreach ($contact_list as $contact) {
//             HfFamilyContact::update([
//                 'contact_id'=>$contact
//                 'family_id'=>$family->id,
//             ]);
//         }

// ------------------------------   ---
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
        if($request->file('ration_img_url')){
                $path = $request->file('ration_img_url')->move('families/rationCardImg/'.$family->id);
                $family->update([
                    // 'family_address_id' => $familyAddress->id,
                    'ration_img_url' => $path,
                ]);
    
            
            
            }
    
          

             $shelter->update([
            'ownership' => $request->shelter_ownership,
            'type' => $request->shelter_type,
            'support_required' => $request->shelter_support_required,
            'family_id' => $family->id,
        ]);

        $bank->update([
            'account_no' => $request->account_no,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'ifsc_code' => $request->ifsc_code,
            'family_id' => $family->id,
        ]);

        $food->update([
            // 'family_id' => $family->id,
            'source' => $request->source,
            'support_required' => $request->support_required,
            'support_req_status' => $request->hsrdd,
        ]);


        $contact_list = [];

        // $data = $request->contacts;
        // return response($data);

        $demoArray = json_decode($request->update, true);
        foreach ((array)$demoArray as $contact) {
            $update=HfContact::where('id',$contact['id'])->update([
                
                'value' => $contact['value'],
            ]);
           
        }



        return response()->json($family, 200);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfTalukAdmin  $hfTalukAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfTalukAdmin $hfTalukAdmin)
    {
        //
    }
}