<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use pxgamer\JustWatch\Apis\Genres;
use GuzzleHttp\Handler\MockHandler;
use pxgamer\JustWatch\Adapters\HttpAdapter;
use pxgamer\JustWatch\Entities\Genre as GenreEntity;

final class GenresApiTest extends TestCase
{
    /** @test */
    public function itCanRetrieveAllGenres(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Genres.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $genres = new Genres($adapter, 'en_US');
        $allGenres = $genres->getAll();

        $this->assertIsArray($allGenres);
        $this->assertCount(2, $allGenres);
        $this->assertContainsOnlyInstancesOf(GenreEntity::class, $allGenres);
    }

    /** @test */
    public function itCanRetrieveActionAndAdventureGenre(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Genres.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $genres = new Genres($adapter, 'en_US');
        /** @var GenreEntity $genre */
        $genre = $genres->getAll()[0];

        $this->assertInstanceOf(GenreEntity::class, $genre);
        $this->assertEquals(1, $genre->id);
        $this->assertEquals('Action & Adventure', $genre->translation);
        $this->assertEquals('act', $genre->shortName);
        $this->assertEquals('action', $genre->technicalName);
        $this->assertEquals('action-and-adventure', $genre->slug);
    }

    /** @test */
    public function itCanRetrieveAnimationGenre(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Genres.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $genres = new Genres($adapter, 'en_US');
        /** @var GenreEntity $genre */
        $genre = $genres->getAll()[1];

        $this->assertInstanceOf(GenreEntity::class, $genre);
        $this->assertEquals(2, $genre->id);
        $this->assertEquals('Animation', $genre->translation);
        $this->assertEquals('ani', $genre->shortName);
        $this->assertEquals('animation', $genre->technicalName);
        $this->assertEquals('animation', $genre->slug);
    }
}
