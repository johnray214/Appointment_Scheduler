<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use Illuminate\Http\JsonResponse;

class BusinessServiceController extends Controller
{
    public function index(BusinessProfile $business): JsonResponse
    {
        return response()->json($business->services);
    }
}
