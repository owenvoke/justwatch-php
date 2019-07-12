<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use pxgamer\JustWatch\Apis\Persons;
use pxgamer\JustWatch\Adapters\HttpAdapter;
use pxgamer\JustWatch\Entities\Person as PersonEntity;

final class PersonsApiTest extends TestCase
{
    /** @test */
    public function itCanRetrieveAPersonByTheirId(): void
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents(__DIR__.'/../Resources/Persons.json')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new HttpAdapter($client);
        $persons = new Persons($adapter);
        /** @var PersonEntity $person */
        $person = $persons->getById(1);

        $this->assertEquals(1, $person->id);
        $this->assertEquals(1.1990000009536743, $person->tmdbPopularity);
        $this->assertEquals('person', $person->objectType);
        $this->assertEquals('Cécile Bois', $person->fullName);
        $this->assertEquals('1971-12-26', $person->dateOfBirth);
        $this->assertEquals(['Cécile Bois', 'Сесиль Буа'], $person->alsoKnownAs);
    }
}
