<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Apis;

use pxgamer\JustWatch\Entities\Movie as MovieEntity;

final class Movies extends AbstractApi
{
    /**
     * @param  int  $id
     *
     * @return MovieEntity
     */
    public function getById(int $id): MovieEntity
    {
        $person = $this->adapter->get(sprintf('%s/titles/movie/%s/locale/%s', $this->endpoint, $id, $this->locale));
        $person = json_decode($person, false);

        return new MovieEntity($person);
    }
}
