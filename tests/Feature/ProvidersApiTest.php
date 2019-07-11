<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use pxgamer\JustWatch\Apis\Providers;
use pxgamer\JustWatch\Adapters\HttpAdapter;
use pxgamer\JustWatch\Entities\Provider as ProviderEntity;

final class ProvidersApiTest extends TestCase
{
    /** @test */
    public function itCanRetrieveAllProviders(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Providers.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $provider = new Providers($adapter, 'en_US');
        $allProviders = $provider->getAll();

        $this->assertIsArray($allProviders);
        $this->assertCount(2, $allProviders);
        $this->assertContainsOnlyInstancesOf(ProviderEntity::class, $allProviders);
    }

    /** @test */
    public function itCanRetrieveNetflixProvider(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Providers.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $provider = new Providers($adapter, 'en_US');
        $allProviders = $provider->getAll()[0];

        $this->assertInstanceOf(ProviderEntity::class, $allProviders);
        $this->assertEquals(8, $allProviders->id);
        $this->assertEquals('Netflix', $allProviders->clearName);
        $this->assertEquals('nfx', $allProviders->shortName);
    }

    /** @test */
    public function itCanRetrieveAmazonProvider(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Providers.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $provider = new Providers($adapter, 'en_US');
        $allProviders = $provider->getAll()[1];

        $this->assertInstanceOf(ProviderEntity::class, $allProviders);
        $this->assertEquals(9, $allProviders->id);
        $this->assertEquals('Amazon Prime Video', $allProviders->clearName);
        $this->assertEquals('amp', $allProviders->shortName);
    }
}
