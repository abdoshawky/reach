<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdResource;
use App\Models\Advertiser;
use Illuminate\Http\JsonResponse;

class AdvertiserAdController extends Controller
{
    public function index(Advertiser $advertiser): JsonResponse
    {
        $ads = $advertiser->ads()->with(['category', 'tags'])->get();
        return response()->json(['ads' => AdResource::collection($ads)]);
    }
}
