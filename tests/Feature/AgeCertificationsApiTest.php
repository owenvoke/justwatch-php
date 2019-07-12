<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use pxgamer\JustWatch\Adapters\HttpAdapter;
use pxgamer\JustWatch\Apis\AgeCertifications;
use pxgamer\JustWatch\Entities\AgeCertification as AgeCertificationEntity;

final class AgeCertificationsApiTest extends TestCase
{
    /** @test */
    public function itCanRetrieveAllMovieAgeCertifications(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/AgeCertifications.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $ageCertification = new AgeCertifications($adapter);
        $allAgeCertifications = $ageCertification->getMovieCertifications();

        $this->assertIsArray($allAgeCertifications);
        $this->assertCount(2, $allAgeCertifications);
        $this->assertContainsOnlyInstancesOf(AgeCertificationEntity::class, $allAgeCertifications);
    }

    /** @test */
    public function itCanRetrieveAllTvAgeCertifications(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/AgeCertifications.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $ageCertification = new AgeCertifications($adapter);
        $allAgeCertifications = $ageCertification->getTvCertifications();

        $this->assertIsArray($allAgeCertifications);
        $this->assertCount(2, $allAgeCertifications);
        $this->assertContainsOnlyInstancesOf(AgeCertificationEntity::class, $allAgeCertifications);
    }

    /** @test */
    public function itCanRetrieveUAgeCertification(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/AgeCertifications.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $ageCertifications = new AgeCertifications($adapter);
        /** @var AgeCertificationEntity $ageCertification */
        $ageCertification = $ageCertifications->getMovieCertifications()[0];

        $this->assertInstanceOf(AgeCertificationEntity::class, $ageCertification);
        $this->assertEquals(72, $ageCertification->id);
        $this->assertEquals('U', $ageCertification->technicalName);
        $this->assertStringStartsWith('All ages admitted, there is nothing', $ageCertification->description);
        $this->assertEquals('movie', $ageCertification->objectType);
        $this->assertEquals('GB', $ageCertification->country);
        $this->assertEquals(1, $ageCertification->order);
        $this->assertEquals('BBFC', $ageCertification->organization);
    }

    /** @test */
    public function itCanRetrievePgAgeCertification(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/AgeCertifications.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $ageCertifications = new AgeCertifications($adapter);
        /** @var AgeCertificationEntity $ageCertification */
        $ageCertification = $ageCertifications->getMovieCertifications()[1];

        $this->assertInstanceOf(AgeCertificationEntity::class, $ageCertification);
        $this->assertEquals(73, $ageCertification->id);
        $this->assertEquals('PG', $ageCertification->technicalName);
        $this->assertStringStartsWith('All ages admitted, but certain scenes', $ageCertification->description);
        $this->assertEquals('movie', $ageCertification->objectType);
        $this->assertEquals('GB', $ageCertification->country);
        $this->assertEquals(2, $ageCertification->order);
        $this->assertEquals('BBFC', $ageCertification->organization);
    }
}
