<?php

namespace DieSchittigs\StarScraper;

class GooglePlaceProvider implements iRatingProvider{
    private $reviews;
    private $BEST_RATING = 5;

    public function __construct($GoogleApiKey, $GoogleMapsPlaceID){
        $placeReviews = [];
        try{
            $placeDetails = json_decode(
                file_get_contents("https://maps.googleapis.com/maps/api/place/details/json?placeid=$GoogleMapsPlaceID&key=$GoogleApiKey")
            );
            $placeReviews = $placeDetails->result->reviews;
        } catch (\Exception $e){
            echo 'Google API returned an error: ' . $e->getMessage();
        }
        if($placeReviews && is_array($placeReviews) && !empty($placeReviews)){
            $this->reviews = $placeReviews;
        }
    }
    public function getRating(){
        if(!$this->reviews) return null;
        $rating = new Rating();
        $rating->bestRating = $this->BEST_RATING;
        $rating->ratingCount = count($this->reviews);
        $score = 0;
        foreach($this->reviews as $review){
            $score += $review->rating;
        }
        $rating->ratingValue = $score / $rating->ratingCount;
        return $rating;
    }
}

