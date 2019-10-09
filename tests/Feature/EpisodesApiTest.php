<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Tests\Feature;

use stdClass;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use pxgamer\JustWatch\Apis\Episodes;
use pxgamer\JustWatch\Adapters\HttpAdapter;
use pxgamer\JustWatch\Entities\Episode as EpisodeEntity;

final class EpisodesApiTest extends TestCase
{
    /** @test */
    public function itCanRetrieveAnEpisodeByItsId(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Episodes.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $episodes = new Episodes($adapter);
        /** @var EpisodeEntity $episode */
        $episode = $episodes->getById(1);

        $this->assertEquals(1, $episode->id);
        $this->assertEquals('The Unknown', $episode->title);
        $this->assertEquals('/poster/8591991/{profile}', $episode->poster);
        $this->assertStringStartsWith('"THE TRUTH ABOUT YOURSELF IS THE HARDEST TO ACCEPT"', $episode->shortDescription);
        $this->assertEquals(2014, $episode->originalReleaseYear);
        $this->assertEquals('show_episode', $episode->objectType);
        $this->assertIsArray($episode->offers);
        $this->assertIsArray($episode->externalIds);
        $this->assertEquals(25, $episode->runtime);
        $this->assertEquals(1, $episode->episodeNumber);
        $this->assertEquals(1, $episode->showId);
        $this->assertEquals('Star Wars: The Clone Wars', $episode->showTitle);
        $this->assertEquals(6, $episode->seasonNumber);
    }

    /** @test */
    public function itCanRetrieveAnEpisodesOffersByItsId(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Episodes.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $episodes = new Episodes($adapter);
        /** @var EpisodeEntity $episode */
        $episode = $episodes->getById(1);
        $offer = $episode->offers[0];

        $this->assertIsArray($episode->offers);
        $this->assertContainsOnlyInstancesOf(stdClass::class, $episode->offers);
        $this->assertEquals('standard', $offer->type);
        $this->assertEquals('buy', $offer->monetization_type);
        $this->assertEquals(7, $offer->provider_id);
        $this->assertEquals(2.99, $offer->retail_price);
        $this->assertEquals('USD', $offer->currency);
        $this->assertStringStartsWith('http://www.vudu.com/movies/#!content/597572', $offer->urls->standard_web);
        $this->assertEquals('hd', $offer->presentation_type);
        $this->assertEquals('2016-10-18_7', $offer->date_provider_id);
        $this->assertEquals('2016-10-18', $offer->date_created);
    }

    /** @test */
    public function itCanRetrieveAnEpisodesExternalIdsByItsId(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Episodes.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $episodes = new Episodes($adapter);
        /** @var EpisodeEntity $episode */
        $episode = $episodes->getById(1);
        $externalId = $episode->externalIds[0];

        $this->assertIsArray($episode->externalIds);
        $this->assertContainsOnlyInstancesOf(stdClass::class, $episode->externalIds);
        $this->assertEquals('tmdb', $externalId->provider);
        $this->assertEquals('4194:6:1', $externalId->external_id);
    }
}
