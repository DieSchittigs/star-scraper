<?php

use DieSchittigs\StarScraper\StarRating;
use DieSchittigs\StarScraper\GooglePlaceProvider;
use DieSchittigs\StarScraper\FacebookPageProvider;
use DieSchittigs\StarScraper\FakeRatingsProvider;

require 'vendor/autoload.php';

$starRating = new StarRating();

$starRating->addProvider(
	new GooglePlaceProvider(
		'{{GoogleApiKey}}',
		'{{GoogleMapsPlaceID}}'
	)
);
$starRating->addProvider(
	new FacebookPageProvider(
		'{{FacebookAppID}}',
		'{{FacebookAppSecret}}',
		'{{FacebookPageID}}'
	)
);

$starRating->addProvider(
	new FakeRatingsProvider([5,4,3,5,4])
);

$starRating->addProvider(
	new FakeRatingsProvider([1,2,1,3,1,3])
);

$rating = $starRating->getRating();

print_r($rating);

echo '
"aggregateRating": {
	"@type": "AggregateRating",
	"bestRating": "'. $rating->bestRating .'",
	"ratingCount": "'. $rating->ratingCount .'",
	"ratingValue": "'. $rating->ratingValue .'"
}
';
