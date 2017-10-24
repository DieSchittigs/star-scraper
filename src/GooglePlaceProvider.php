<?php

namespace DieSchittigs\StarScraper;

class GooglePlaceProvider extends RatingProvider{

    use BrowserTrait;

    private $reviews;

    public function __construct($GoogleApiKey, $GoogleMapsPlaceID){
        $placeReviews = [];
        try{
            $response = $this->getBrowser()->get("https://maps.googleapis.com/maps/api/place/details/json?placeid=$GoogleMapsPlaceID&key=$GoogleApiKey");
            $placeDetails = json_decode($response->getContent());
            $placeReviews = $placeDetails->result->reviews;
        } catch (\Exception $e){
            echo 'Google API returned an error: ' . $e->getMessage();
        }
        if($placeReviews && is_array($placeReviews) && !empty($placeReviews)){
            $this->reviews = $placeReviews;
        }
    }
    public function getRating($method = 'median'){
        if(!$this->reviews) return null;
        $rating = new Rating($this->bestRating);
        $scores = [];
        foreach($this->reviews as $review){
            $scores[] = $review->rating;
        }
        $rating->avgRatingValue($scores, $method, true);
        return $rating;
    }
}
