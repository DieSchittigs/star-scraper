<?php

namespace DieSchittigs\StarScraper;

use Facebook\Facebook;

class FacebookPageProvider implements iRatingProvider{
    private $BEST_RATING = 5;
    private $result;

    public function __construct($appID, $appSecret, $pageId){
        $fb = new Facebook([
            'app_id' => $appID,
            'app_secret' => $appSecret,
            'default_graph_version' => 'v2.10',
            'default_access_token' => "$appID|$appSecret"
        ]);
        try {
            $response = $fb->get("$pageId?fields=overall_star_rating,rating_count");
            $this->result = $response->getDecodedBody();
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
        }
    }
    public function getRating(){
        if(
            !$this->result ||
            !$this->result['id'] ||
            !$this->result['rating_count'] ||
            !$this->result['overall_star_rating']
        ) return null;
        $rating = new Rating();
        $rating->bestRating = $this->BEST_RATING;
        $rating->ratingCount = $this->result['rating_count'];
        $rating->ratingValue = $this->result['overall_star_rating'];
        return $rating;
    }
}

