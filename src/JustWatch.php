<?php

declare(strict_types=1);

namespace pxgamer\JustWatch;

use pxgamer\JustWatch\Adapters\HttpAdapter;

final class JustWatch
{
    /** @var HttpAdapter */
    protected $adapter;

    public function __construct(HttpAdapter $adapter)
    {
        $this->adapter = $adapter;
    }
}
