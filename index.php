<?php

use DieSchittigs\StarScraper\StarRating;
use DieSchittigs\StarScraper\GooglePlaceProvider;
use DieSchittigs\StarScraper\FacebookPageProvider;

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
		'{{FacebookPage}}'
	)
);

$rating = $starRating->getRating();

echo '
"aggregateRating": {
	"@type": "AggregateRating",
	"bestRating": "'. $rating->bestRating .'",
	"ratingCount": "'. $rating->ratingCount .'",
	"ratingValue": "'. $rating->ratingValue .'"
}
';
