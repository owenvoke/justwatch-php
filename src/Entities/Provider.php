<?php

namespace pxgamer\JustWatch\Entities;

use stdClass;

final class Provider extends AbstractEntity
{
    /** @var int */
    public $id;
    /** @var int */
    public $profileId;
    /** @var string */
    public $technicalName;
    /** @var string */
    public $shortName;
    /** @var string */
    public $clearName;
    /** @var bool */
    public $hasGlobalAccount;
    /** @var bool */
    public $canCreateTitle;
    /** @var stdClass */
    public $data;
    /** @var stdClass */
    public $profileData;
    /** @var int */
    public $priority;
    /** @var int */
    public $displayPriority;
    /** @var array<string> */
    public $domains;
    /** @var array<int, string> */
    public $monetizationTypes;
    /** @var string */
    public $iconUrl;
    /** @var string */
    public $slug;
}
