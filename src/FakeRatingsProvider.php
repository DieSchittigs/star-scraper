<?php

namespace DieSchittigs\StarScraper;

use Facebook\Facebook;

class FakeRatingsProvider extends RatingProvider{
    private $scores;

    public function __construct(Array $scores = [3,1,4,2,5]){
        $this->scores = $scores;
    }
    public function getRating($method = 'median'){
        $rating = new Rating($this->bestRating);
        $rating->avgRatingValue($this->scores, $method, true);
        return $rating;
    }
}

