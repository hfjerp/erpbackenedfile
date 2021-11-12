<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function files()
    {
        return response()->json('Nothing');
    }

    public function upload(Request $request)
    {
        
        return response()->json($request);
    }
}
