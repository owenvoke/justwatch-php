<?php

namespace pxgamer\JustWatch\Entities;

use stdClass;

final class Show extends AbstractEntity
{
    /** @var int */
    public $id;
    /** @var string */
    public $title;
    /** @var string */
    public $fullPath;
    /** @var array<string, string> */
    public $fullPaths;
    /** @var string */
    public $poster;
    /** @var array<int, string> */
    public $backdrops;
    /** @var string */
    public $shortDescription;
    /** @var int */
    public $originalReleaseYear;
    /** @var float */
    public $tmdbPopularity;
    /** @var string */
    public $objectType;
    /** @var string */
    public $originalTitle;
    /** @var array<int, stdClass> */
    public $offers;
    /** @var array<int, stdClass> */
    public $clips;
    /** @var array<int, stdClass> */
    public $scoring;
    /** @var array<int, stdClass> */
    public $credits;
    /** @var array<int, stdClass> */
    public $externalIds;
    /** @var string */
    public $originalLanguage;
    /** @var array<int, int> */
    public $genreIds;
    /** @var string */
    public $ageCertification;
    /** @var int */
    public $maxSeasonNumber;
    /** @var array<int, stdClass> */
    public $seasons;
}
