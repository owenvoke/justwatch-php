<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Tests\Feature;

use stdClass;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use pxgamer\JustWatch\Apis\Movies;
use GuzzleHttp\Handler\MockHandler;
use pxgamer\JustWatch\Adapters\HttpAdapter;
use pxgamer\JustWatch\Entities\Movie as MovieEntity;

final class MoviesApiTest extends TestCase
{
    /** @test */
    public function itCanRetrieveAMovieByItsId(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Movies.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $movies = new Movies($adapter);
        /** @var MovieEntity $movie */
        $movie = $movies->getById(1);

        $this->assertEquals(1, $movie->id);
        $this->assertEquals('Star Wars', $movie->title);
        $this->assertEquals('/us/movie/star-wars-episode-iv-a-new-hope', $movie->fullPath);
        $this->assertEquals(
            (object) ['MOVIE_DETAIL_OVERVIEW' => '/us/movie/star-wars-episode-iv-a-new-hope'],
            $movie->fullPaths
        );
        $this->assertEquals('/poster/8539293/{profile}', $movie->poster);
        $this->assertStringStartsWith('Princess Leia is captured and held hostage by', $movie->shortDescription);
        $this->assertEquals(1977, $movie->originalReleaseYear);
        $this->assertEquals(36.387, $movie->tmdbPopularity);
        $this->assertEquals('movie', $movie->objectType);
        $this->assertEquals('Star Wars', $movie->originalTitle);
        $this->assertEquals('en', $movie->originalLanguage);
        $this->assertIsArray($movie->genreIds);
        $this->assertEquals('PG', $movie->ageCertification);
        $this->assertEquals(121, $movie->runtime);
    }

    /** @test */
    public function itCanRetrieveAMoviesOffersByItsId(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Movies.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $movies = new Movies($adapter);
        /** @var MovieEntity $movie */
        $movie = $movies->getById(1);
        $offer = $movie->offers[0];

        $this->assertIsArray($movie->offers);
        $this->assertContainsOnlyInstancesOf(stdClass::class, $movie->offers);
        $this->assertEquals('buy', $offer->monetization_type);
        $this->assertEquals(18, $offer->provider_id);
        $this->assertEquals(19.99, $offer->retail_price);
        $this->assertEquals('USD', $offer->currency);
        $this->assertEquals('hd', $offer->presentation_type);
        $this->assertEquals('2015-06-04_18', $offer->date_provider_id);
        $this->assertEquals('2015-06-04', $offer->date_created);
        $this->assertStringStartsWith('https://store.playstation.com', $offer->urls->standard_web);
    }

    /** @test */
    public function itCanRetrieveAMoviesClipsByItsId(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Movies.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $movies = new Movies($adapter);
        /** @var MovieEntity $movie */
        $movie = $movies->getById(1);
        $clip = $movie->clips[0];

        $this->assertIsArray($movie->clips);
        $this->assertContainsOnlyInstancesOf(stdClass::class, $movie->clips);
        $this->assertEquals('trailer', $clip->type);
        $this->assertEquals('youtube', $clip->provider);
        $this->assertEquals('i-vsILeJ8_8', $clip->external_id);
        $this->assertEquals('Star Wars: Teaser Trailer', $clip->name);
    }

    /** @test */
    public function itCanRetrieveAMoviesScoringByItsId(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Movies.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $movies = new Movies($adapter);
        /** @var MovieEntity $movie */
        $movie = $movies->getById(1);
        $score = $movie->scoring[0];

        $this->assertIsArray($movie->scoring);
        $this->assertContainsOnlyInstancesOf(stdClass::class, $movie->scoring);
        $this->assertEquals('tomato:meter', $score->provider_type);
        $this->assertEquals(93, $score->value);
    }

    /** @test */
    public function itCanRetrieveAMoviesCreditsByItsId(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Movies.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $movies = new Movies($adapter);
        /** @var MovieEntity $movie */
        $movie = $movies->getById(1);
        $credit = $movie->credits[0];

        $this->assertIsArray($movie->credits);
        $this->assertContainsOnlyInstancesOf(stdClass::class, $movie->credits);
        $this->assertEquals('ACTOR', $credit->role);
        $this->assertEquals('Luke Skywalker', $credit->character_name);
        $this->assertEquals(1989, $credit->person_id);
        $this->assertEquals('Mark Hamill', $credit->name);
    }
}
