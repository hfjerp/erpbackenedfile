<?php

namespace App\Http\Controllers;

use App\Models\HfFamily;
use App\Models\HfFamilyMember;
use App\Models\HfJamath;
use App\Models\HfUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AnalyticController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

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
        return response()->json($data);

    }
}
