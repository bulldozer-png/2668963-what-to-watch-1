<?php

use App\Repository\OmdbMovieRepository;
use App\Service\MovieService;

$client = new \GuzzleHttp\Client();
$repository = new OmdbMovieRepository($client);
$service = new MovieService($repository);

$result = $service->getMovieByImdbId('tt1853728');

print_r($result);
