<?php

namespace DieSchittigs\StarScraper;

use Median\Median;

class Rating{
    public $bestRating;
    public $ratingCount;
    public $ratingValue;
    public function __construct($bestRating = 0, $ratingCount = 0, $ratingValue = 0){
        $this->bestRating = $bestRating;
        $this->ratingCount = $ratingCount;
        $this->ratingValue = $ratingValue;
    }
    public function isValid(){
        return (
            $this->bestRating > 0 &&
            $this->ratingCount > 0 &&
            $this->ratingValue >= 0
        );
    }
    public function avgRatingValue(Array $scores, $method = 'median', $doSetRatingCount = false){
        if($doSetRatingCount) $this->ratingCount = count($scores);
        $avg = new Median($scores);
        switch($method){
            case 'mean':
                $this->ratingValue =  $avg->average();
                return true;
            case 'median':
                $this->ratingValue = $avg->median();
                return true;
        }
        return false;
    }
}
