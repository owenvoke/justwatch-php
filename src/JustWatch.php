<?php

declare(strict_types=1);

namespace pxgamer\JustWatch;

use pxgamer\JustWatch\Adapters\HttpAdapter;
use pxgamer\JustWatch\Apis\AgeCertifications;
use pxgamer\JustWatch\Apis\Episodes;
use pxgamer\JustWatch\Apis\Genres;
use pxgamer\JustWatch\Apis\Persons;
use pxgamer\JustWatch\Apis\Providers;
use pxgamer\JustWatch\Apis\Shows;

final class JustWatch
{
    /** @var HttpAdapter */
    protected $adapter;

    /** @var string */
    protected $locale;

    public function __construct(HttpAdapter $adapter, ?string $locale = null)
    {
        $this->adapter = $adapter;
        $this->locale = $locale ?? 'en_US';
    }

    public function ageCertifications(): AgeCertifications
    {
        return new AgeCertifications($this->adapter, $this->locale);
    }

    public function episodes(): Episodes
    {
        return new Episodes($this->adapter, $this->locale);
    }

    public function genres(): Genres
    {
        return new Genres($this->adapter, $this->locale);
    }

    public function movies(): Movies
    {
        return new Movies($this->adapter, $this->locale);
    }

    public function persons(): Persons
    {
        return new Persons($this->adapter, $this->locale);
    }

    public function providers(): Providers
    {
        return new Providers($this->adapter, $this->locale);
    }

    public function shows(): Shows
    {
        return new Shows($this->adapter, $this->locale);
    }
}
