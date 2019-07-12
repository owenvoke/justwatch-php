<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Apis;

use pxgamer\JustWatch\Entities\Person as PersonEntity;

final class Persons extends AbstractApi
{
    /**
     * @param  int  $id
     *
     * @return PersonEntity
     */
    public function getById(int $id): PersonEntity
    {
        $person = $this->adapter->get(sprintf('%s/titles/person/%s/locale/%s', $this->endpoint, $id, $this->locale));
        $person = json_decode($person, false);

        return new PersonEntity($person);
    }
}
