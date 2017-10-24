<?php

namespace DieSchittigs\StarScraper;

abstract class RatingProvider{
    public $bestRating = 5;

    public function getRating($method = 'median'){
        $scores = [2,4,1,5];
        $rating = new Rating($this->bestRating, count($scores));
        $rating->setAvgRatingValue($scores, $method);
        return $rating;
    }
}
