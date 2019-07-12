<?php

namespace pxgamer\JustWatch\Entities;

final class Person extends AbstractEntity
{
    /** @var int */
    public $id;
    /** @var float */
    public $tmdbPopularity;
    /** @var string */
    public $objectType;
    /** @var string */
    public $fullName;
    /** @var string */
    public $dateOfBirth;
    /** @var array<int, string> */
    public $alsoKnownAs;
}
