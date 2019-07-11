<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Apis;

use pxgamer\JustWatch\Adapters\HttpAdapter;

abstract class AbstractApi
{
    /** @var string */
    public const ENDPOINT = 'https://apis.justwatch.com/content';

    /** @var HttpAdapter */
    protected $adapter;

    /** @var string */
    protected $endpoint;

    /** @var string */
    protected $locale;

    public function __construct(HttpAdapter $adapter, ?string $locale = null, ?string $endpoint = null)
    {
        $this->adapter = $adapter;
        $this->locale = $locale ?? 'en_US';
        $this->endpoint = $endpoint ?: static::ENDPOINT;
    }
}
