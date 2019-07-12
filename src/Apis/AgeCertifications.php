<?php

declare(strict_types=1);

namespace pxgamer\JustWatch\Apis;

use pxgamer\JustWatch\Entities\AgeCertification as AgeCertificationEntity;

final class AgeCertifications extends AbstractApi
{
    private const DEFAULT_COUNTRY = 'US';

    /**
     * @param  string|null  $country
     *
     * @return array<AgeCertificationEntity>
     */
    public function getMovieCertifications(?string $country = null): array
    {
        $query = http_build_query([
            'country' => $country ?? self::DEFAULT_COUNTRY,
            'object_type' => 'movie',
        ]);

        $ageCertifications = $this->adapter->get(sprintf('%s/age_certifications?%s', $this->endpoint, $query));
        $ageCertifications = json_decode($ageCertifications, false);

        return array_map(static function ($ageCertification) {
            return new AgeCertificationEntity($ageCertification);
        }, $ageCertifications);
    }

    /**
     * @param  string|null  $country
     *
     * @return array<AgeCertificationEntity>
     */
    public function getTvCertifications(?string $country = null): array
    {
        $query = http_build_query([
            'country' => $country ?? self::DEFAULT_COUNTRY,
            'object_type' => 'show',
        ]);

        $ageCertifications = $this->adapter->get(sprintf('%s/age_certifications?%s', $this->endpoint, $query));
        $ageCertifications = json_decode($ageCertifications, false);

        return array_map(static function ($ageCertification) {
            return new AgeCertificationEntity($ageCertification);
        }, $ageCertifications);
    }
}
