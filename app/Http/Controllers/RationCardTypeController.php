<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RationCardTypeController extends Controller
{
    public function index()
    {
        $data = ['APL','BPL'];

        return response()->json($data);
    }
}
