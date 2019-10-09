<?php

namespace pxgamer\JustWatch\Entities;

use stdClass;

final class Episode extends AbstractEntity
{
    /** @var int */
    public $id;
    /** @var string */
    public $title;
    /** @var string */
    public $poster;
    /** @var string */
    public $shortDescription;
    /** @var int */
    public $originalReleaseYear;
    /** @var string */
    public $objectType;
    /** @var array<int, stdClass> */
    public $offers;
    /** @var array<int, stdClass> */
    public $externalIds;
    /** @var int */
    public $runtime;
    /** @var int */
    public $episodeNumber;
    /** @var int */
    public $showId;
    /** @var string */
    public $showTitle;
    /** @var int */
    public $seasonNumber;
}
