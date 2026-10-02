<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GoogleReviewService
{
    public static function getReviews()
    {
        return Cache::remember('google_reviews_v2', now()->addDay(), function () {

            $response = Http::get(
                'https://maps.googleapis.com/maps/api/place/details/json',
                [
                    'place_id' => config('services.google.place_id'),
                    'fields'   => 'name,rating,user_ratings_total,reviews',
                    'key'      => config('services.google.api_key'),
                ]
            );

            return $response->json('result') ?? [];
        });
    }
}
