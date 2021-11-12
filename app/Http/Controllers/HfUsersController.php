<?php

namespace App\Http\Controllers;

use App\Models\HfUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class HfUsersController extends Controller
{
    public function __construct(HfUser $hfUser)
    {
        $this->middleware('auth:api');
        $this->HfUser = $hfUser;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function index()
    {
        $userId = auth()->user()->id;
        if ($userId == 1) {
            $users = HfUser::where('parent_id', $userId)->get();
            $data = $this->HfUser->getUsers($users);

            return response()->json($data, 200);
        }
        $users = HfUser::where('parent_id', $userId)->get();
        $data = $this->HfUser->getUsers($users);


        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->email);
        $data['remember_token'] = Str::random(10);
        $data['parent_id'] = $request->parent_id;
        // return response($data);
        $hfUser = HfUser::create($data);

        return response($hfUser);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HfUser  $hfUser
     * @return \Illuminate\Http\Response
     */
    public function show(HfUser $hfUser)
    {
        $data = [
            $hfUser,
            $hfUser->jamath,
            $hfUser->role,
        ];
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HfUser  $hfUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HfUser $hfUser)
    {
        $hfUser->update($request->all());

        return response()->json($hfUser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HfUser  $hfUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(HfUser $hfUser)
    {
        //
    }

    public function userList($id)
    {
        $users = HfUser::where('parent_id', $id)->get();
        if($users){
            return response()->json($users);
        }
        return response()->json(['msg'=>"There is no users"], 500);
    }
}
