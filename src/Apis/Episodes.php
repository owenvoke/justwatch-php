<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Apis;

use pxgamer\JustWatch\Entities\Episode as EpisodeEntity;

final class Episodes extends AbstractApi
{
    public function getById(int $id): EpisodeEntity
    {
        $episode = $this->adapter->get(sprintf('%s/titles/show_episode/%s/locale/%s', $this->endpoint, $id, $this->locale));
        $episode = json_decode($episode, false);

        return new EpisodeEntity($episode);
    }
}
