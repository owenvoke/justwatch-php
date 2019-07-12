<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Apis;

use pxgamer\JustWatch\Entities\Genre as GenreEntity;

final class Genres extends AbstractApi
{
    /**
     * @return array<GenreEntity>
     */
    public function getAll(): array
    {
        $genres = $this->adapter->get(sprintf('%s/genres/locale/%s', $this->endpoint, $this->locale));
        $genres = json_decode($genres, false);

        return array_map(static function ($genre) {
            return new GenreEntity($genre);
        }, $genres);
    }
}
