<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use pxgamer\JustWatch\Adapters\HttpAdapter;
use pxgamer\JustWatch\Apis\Providers;
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
        $providers = new Providers($adapter, 'en_US');
        $allProviders = $providers->getAll();

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
        $providers = new Providers($adapter, 'en_US');
        $provider = $providers->getAll()[0];

        $this->assertInstanceOf(ProviderEntity::class, $provider);
        $this->assertEquals(8, $provider->id);
        $this->assertEquals('Netflix', $provider->clearName);
        $this->assertEquals('nfx', $provider->shortName);
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
        $providers = new Providers($adapter, 'en_US');
        $provider = $providers->getAll()[1];

        $this->assertInstanceOf(ProviderEntity::class, $provider);
        $this->assertEquals(9, $provider->id);
        $this->assertEquals('Amazon Prime Video', $provider->clearName);
        $this->assertEquals('amp', $provider->shortName);
    }
}
