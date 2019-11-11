<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use pxgamer\JustWatch\Adapters\HttpAdapter;
use pxgamer\JustWatch\Apis\Shows;
use pxgamer\JustWatch\Entities\Show as ShowEntity;
use stdClass;

final class ShowsApiTest extends TestCase
{
    /** @test */
    public function itCanRetrieveAShowByItsId(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Shows.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $shows = new Shows($adapter);
        /** @var ShowEntity $show */
        $show = $shows->getById(1);

        $this->assertEquals(1, $show->id);
        $this->assertEquals('Star Wars: The Clone Wars', $show->title);
        $this->assertEquals('/us/tv-show/star-wars-the-clone-wars', $show->fullPath);
        $this->assertEquals(
            (object) ['SHOW_DETAIL_OVERVIEW' => '/us/tv-show/star-wars-the-clone-wars'],
            $show->fullPaths
        );
        $this->assertEquals('/poster/19147561/{profile}', $show->poster);
        $this->assertStringStartsWith('Yoda, Obi-Wan Kenobi, Anakin Skywalker, Mace Windu', $show->shortDescription);
        $this->assertEquals(2008, $show->originalReleaseYear);
        $this->assertEquals(49.372, $show->tmdbPopularity);
        $this->assertEquals('show', $show->objectType);
        $this->assertEquals('Star Wars: The Clone Wars', $show->originalTitle);
        $this->assertEquals('en', $show->originalLanguage);
        $this->assertIsArray($show->genreIds);
        $this->assertEquals('TV-PG', $show->ageCertification);
        $this->assertEquals(6, $show->maxSeasonNumber);
    }

    /** @test */
    public function itCanRetrieveAShowsOffersByItsId(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Shows.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $shows = new Shows($adapter);
        /** @var ShowEntity $show */
        $show = $shows->getById(1);
        $offer = $show->offers[0];

        $this->assertIsArray($show->offers);
        $this->assertContainsOnlyInstancesOf(stdClass::class, $show->offers);
        $this->assertEquals('aggregated', $offer->type);
        $this->assertEquals('buy', $offer->monetization_type);
        $this->assertEquals(2, $offer->provider_id);
        $this->assertEquals(134.94, $offer->retail_price);
        $this->assertEquals('USD', $offer->currency);
        $this->assertEquals('sd', $offer->presentation_type);
        $this->assertEquals(6, $offer->element_count);
        $this->assertEquals(6, $offer->new_element_count);
        $this->assertEquals('2017-02-26_2', $offer->date_provider_id);
        $this->assertEquals('2017-02-26', $offer->date_created);
        $this->assertStringStartsWith('https://itunes.apple.com/us/tv-season', $offer->urls->standard_web);
    }

    /** @test */
    public function itCanRetrieveAShowsClipsByItsId(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Shows.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $shows = new Shows($adapter);
        /** @var ShowEntity $show */
        $show = $shows->getById(1);
        $clip = $show->clips[0];

        $this->assertIsArray($show->clips);
        $this->assertContainsOnlyInstancesOf(stdClass::class, $show->clips);
        $this->assertEquals('trailer', $clip->type);
        $this->assertEquals('youtube', $clip->provider);
        $this->assertEquals('Y6WcmKRvHpk', $clip->external_id);
        $this->assertEquals('STAR WARS: The Clone Wars Trailer (2019)', $clip->name);
    }

    /** @test */
    public function itCanRetrieveAShowsScoringByItsId(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Shows.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $shows = new Shows($adapter);
        /** @var ShowEntity $show */
        $show = $shows->getById(1);
        $score = $show->scoring[0];

        $this->assertIsArray($show->scoring);
        $this->assertContainsOnlyInstancesOf(stdClass::class, $show->scoring);
        $this->assertEquals('imdb:votes', $score->provider_type);
        $this->assertEquals(39869, $score->value);
    }

    /** @test */
    public function itCanRetrieveAShowsCreditsByItsId(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Shows.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $shows = new Shows($adapter);
        /** @var ShowEntity $show */
        $show = $shows->getById(1);
        $credit = $show->credits[0];

        $this->assertIsArray($show->credits);
        $this->assertContainsOnlyInstancesOf(stdClass::class, $show->credits);
        $this->assertEquals('ACTOR', $credit->role);
        $this->assertEquals('Obi-Wan Kenobi', $credit->character_name);
        $this->assertEquals(18054, $credit->person_id);
        $this->assertEquals('James Arnold Taylor', $credit->name);
    }

    /** @test */
    public function itCanRetrieveAShowsSeasonsByItsId(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Shows.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $shows = new Shows($adapter);
        /** @var ShowEntity $show */
        $show = $shows->getById(1);
        $season = $show->seasons[0];

        $this->assertIsArray($show->seasons);
        $this->assertContainsOnlyInstancesOf(stdClass::class, $show->seasons);
        $this->assertEquals(3, $season->id);
        $this->assertEquals('Season 1', $season->title);
        $this->assertEquals('/us/tv-show/star-wars-the-clone-wars/season-1', $season->full_path);
        $this->assertEquals('/poster/8592028/{profile}', $season->poster);
        $this->assertEquals(1, $season->season_number);
    }
}
