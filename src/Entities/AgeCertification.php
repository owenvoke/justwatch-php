<?php

namespace pxgamer\JustWatch\Entities;

final class AgeCertification extends AbstractEntity
{
    /** @var int */
    public $id;
    /** @var string */
    public $technicalName;
    /** @var string */
    public $description;
    /** @var string */
    public $objectType;
    /** @var string */
    public $country;
    /** @var int */
    public $order;
    /** @var string */
    public $organization;
}
