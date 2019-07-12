<?php

namespace pxgamer\JustWatch\Entities;

final class Genre extends AbstractEntity
{
    /** @var int */
    public $id;
    /** @var string */
    public $translation;
    /** @var string */
    public $shortName;
    /** @var string */
    public $technicalName;
    /** @var string */
    public $slug;
}
