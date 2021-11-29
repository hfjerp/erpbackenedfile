<?php

namespace App\Http\Controllers;

use App\Models\HfJamath;
use Illuminate\Http\Request;
use DB;
class HfJamathController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', /*['except' => ['login']]*/);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hfJamaths = HfJamath::all();
        $data = $hfJamaths->map(function ($hfJamath) {
            return [
                $hfJamath,
                $hfJamath->address
            ];
        });
        return response()->json($hfJamaths);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        

        $hfJamath = HfJamath::create($data);

        
       $id =  $hfJamath->id;
       $uid =  $hfJamath->user_id;
       DB::update("UPDATE `hf_users` SET `jamath_id` = '".$id."' WHERE `hf_users`.`id` = '".$uid."'");
       return response()->json([
        'msg' => "Successfully created a new HfJamath entry",
        'jamath' => $hfJamath,
        'od' => $id,
        'uid'=>$uid,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfJamath  $hfJamath
     * @return \Illuminate\Http\Response
     */
    public function show(HfJamath $hfJamath)
    {
        $data = $hfJamath->getJamathDetail($hfJamath);

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfJamath  $hfJamath
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfJamath $hfJamath)
    {
        $data= $request->json()->all();
        $data['created_by_id'] = auth()->user()->id;
        $hfJamath->update($data);

        return response()->json(['msg']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfJamath  $hfJamath
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfJamath $hfJamath)
    {
        //
    }

    public function jamaths($id)
    {
        $allJamaths = HfJamath::where('taluk_id', $id)->get();
        if ($allJamaths) {
            return response()->json($allJamaths);
        }
        return response()->json(['msg' => "There is no entry of Jamaths for this Taluk"], 500);
    }


    public function filterjamaths()
    {
        $allJamathss = HfJamath::all();
        if ($allJamathss) {
            return response()->json($allJamathss);
        }
        return response()->json(['msg' => "There is no entry of Jamaths for this Taluk"], 500);
    }

    public function jamtal($id)
    {
        $allJamaths = HfJamath::where('taluk_id', $id)->get();
        if ($allJamaths) {
            return response()->json($allJamaths);
        }
        return response()->json(['msg' => "There is no entry of Jamaths for this Taluk"], 500);
    }
}
