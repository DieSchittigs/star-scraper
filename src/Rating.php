<?php

namespace DieSchittigs\StarScraper;

use MathPHP\Statistics\Average;

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
        switch($method){
            case 'mean':
                $this->ratingValue = Average::mean($scores);
                return true;
            case 'median':
                $this->ratingValue = Average::median($scores);
                return true;
        }
        return false;
    }
}
