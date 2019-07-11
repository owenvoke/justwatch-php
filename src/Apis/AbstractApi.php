<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Apis;

use pxgamer\JustWatch\Adapters\HttpAdapter;

abstract class AbstractApi
{
    /** @var string */
    public const ENDPOINT = 'https://apis.justwatch.com';

    /** @var HttpAdapter */
    protected $adapter;

    /** @var string */
    protected $endpoint;

    public function __construct(HttpAdapter $adapter, ?string $endpoint = null)
    {
        $this->adapter = $adapter;
        $this->endpoint = $endpoint ?: static::ENDPOINT;
    }
}
