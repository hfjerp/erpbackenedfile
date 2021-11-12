<?php

namespace App\Http\Controllers;

use App\Models\HfShelterOwnership;
use App\Models\HfShelterType;
use Illuminate\Http\Request;

class MixController extends Controller
{
    public function shelterTypeList()
    {
        $allShelterTypes = HfShelterType::all();

        return response()->json($allShelterTypes);
    }

    public function shelterOwnershipList()
    {
        $allShelterOwnershipTypes = HfShelterOwnership::all();

        return response()->json($allShelterOwnershipTypes);
    }
}
