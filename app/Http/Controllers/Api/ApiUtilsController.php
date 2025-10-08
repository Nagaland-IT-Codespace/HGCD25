<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DistrictMaster;
use App\Models\LocationMaster;
use Illuminate\Http\Request;

class ApiUtilsController extends Controller
{
    public function getDistricts(Request $request)
    {
        $districts = DistrictMaster::all();
        return response()->json(['districts' => $districts]);
    }
    public function getLocations(Request $request)
    {
        $district_id = $request->query('district_id');
        if (!$district_id) {
            return response()->json(['error' => 'district_id parameter is required'], 400);
        }

        $locations = LocationMaster::where('district_id', $district_id)->get();
        return response()->json(['locations' => $locations]);
    }
}
