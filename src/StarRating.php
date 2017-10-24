<?php

namespace DieSchittigs\StarScraper;

class StarRating extends RatingProvider{
    private $providers = [];
    public function __construct($bestRating = null){
        if($bestRating) $this->bestRating = $bestRating;
    }
    public function addProvider(RatingProvider $provider){
        $this->providers[] = $provider;
    }
    public function getRating($method = 'median'){
        if(!$this->providers) return null;
        $rating = new Rating($this->bestRating);
        $rating->ratingCount = 0;
        $scores = [];
        foreach($this->providers as $provider){
            $_rating = $provider->getRating();
            if(!$_rating || !$_rating->isValid()) continue;
            $rating->ratingCount += $_rating->ratingCount;
            $scores[] = $_rating->ratingValue / $_rating->bestRating * $rating->bestRating;
        }
        $rating->avgRatingValue($scores, $method);
        return $rating;
    }
}
