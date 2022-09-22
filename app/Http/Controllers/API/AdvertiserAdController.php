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
        $ads = $advertiser->ads()->with(['category', 'tags']);

        if (request('category_id')) {
            $ads = $ads->where('category_id', request('category_id'));
        }

        if (request('tags')) {
            $ads = $ads->whereHas('tags', function ($query) {
                $query->whereIn('tags.id', request('tags'));
            });
        }

        $ads = $ads->get();
        return response()->json(['ads' => AdResource::collection($ads)]);
    }
}
