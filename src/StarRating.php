<?php

namespace DieSchittigs\StarScraper;

class StarRating implements iRatingProvider{
    private $providers = [];
    private $best_rating;
    public function __construct($best_rating = 5){
        $this->best_rating = $best_rating;
    }
    public function addProvider(iRatingProvider $provider){
        $this->providers[] = $provider;
    }
    public function getRating(){
        if(!$this->providers) return null;
        $rating = new Rating;
        $rating->bestRating = $this->best_rating;
        $rating->ratingCount = 0;
        $score = 0;
        $validProviders = 0;
        foreach($this->providers as $provider){
            $_rating = $provider->getRating();
            if(!$_rating) continue;
            $rating->ratingCount += $_rating->ratingCount;
            $score += $_rating->ratingValue / $_rating->bestRating * $rating->bestRating;
            $validProviders ++;
        }
        $rating->ratingValue = $score / $validProviders;
        return $rating;
    }
}