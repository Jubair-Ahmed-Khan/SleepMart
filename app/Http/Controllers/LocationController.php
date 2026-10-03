<?php

namespace App\Http\Controllers;

use App\Models\BdDistrict;
use App\Models\BdDivision;
use App\Models\BdUpazila;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    public function divisions(): JsonResponse
    {
        $divisions = BdDivision::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get([
                'id',
                'name',
                'name_bn',
            ]);

        return response()->json(
            $divisions
        );
    }

    public function districts(
        BdDivision $division
    ): JsonResponse {
        $districts = $division
            ->districts()
            ->where('is_active', true)
            ->orderBy('name')
            ->get([
                'id',
                'division_id',
                'name',
                'name_bn',
            ]);

        return response()->json(
            $districts
        );
    }

    public function upazilas(
        BdDistrict $district
    ): JsonResponse {
        $upazilas = $district
            ->upazilas()
            ->where('is_active', true)
            ->orderBy('name')
            ->get([
                'id',
                'district_id',
                'name',
                'name_bn',
            ]);

        return response()->json(
            $upazilas
        );
    }
}