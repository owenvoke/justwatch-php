<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Apis;

use pxgamer\JustWatch\Entities\Show as ShowEntity;

final class Shows extends AbstractApi
{
    /**
     * @param  int  $id
     *
     * @return ShowEntity
     */
    public function getById(int $id): ShowEntity
    {
        $person = $this->adapter->get(sprintf('%s/titles/show/%s/locale/%s', $this->endpoint, $id, $this->locale));
        $person = json_decode($person, false);

        return new ShowEntity($person);
    }
}
