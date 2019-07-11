<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Apis;

use pxgamer\JustWatch\Entities\Provider as ProviderEntity;

final class Providers extends AbstractApi
{
    /**
     * @return ProviderEntity[]
     */
    public function getAll(): array
    {
        $providers = $this->adapter->get(sprintf('%s/providers/locale/%s', $this->endpoint, $this->locale));
        $providers = json_decode($providers, false);

        return array_map(static function ($provider) {
            return new ProviderEntity($provider);
        }, $providers);
    }
}
