<?php

/*
 * This file is part of the abgeo/covid19-cli package.
 *
 * (c) Temuri Takalandze <me@abgeo.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ABGEO\COVID\Service;

use ABGEO\COVID\Model\CountryData;

/**
 * Class StatisticsService.
 *
 * @categhory Service
 * @package   ABGEO\COVID
 */
class StatisticsService
{
    /**
     * @var APIService
     */
    private $APIService;

    public function __construct()
    {
        $this->APIService = new APIService();
    }

    /**
     * @param string $slug
     * @return CountryData
     * @throws \ABGEO\COVID\Exception\InvalidSlugException
     */
    public function getCountryYesterday(string $slug)
    {
        $data = $this->APIService->getCountryData($slug);

        $confirmed = $data['confirmed'][count($data['confirmed']) - 2] ?? [];
        $recovered = $data['recovered'][count($data['recovered']) - 2] ?? [];
        $deaths = $data['deaths'][count($data['deaths']) - 2] ?? [];

        return (new CountryData())
            ->setCountry($data['country'])
            ->setDate(\DateTime::createFromFormat(\DateTimeInterface::ATOM, $confirmed['Date'] ?? null))
            ->setConfirmed($confirmed['Cases'] ?? null)
            ->setRecovered($recovered['Cases'] ?? null)
            ->setDeaths($deaths['Cases'] ?? null);
    }

    /**
     * @param string $slug
     * @return CountryData
     * @throws \ABGEO\COVID\Exception\InvalidSlugException
     */
    public function getCountryLive(string $slug)
    {
        $data = $this->APIService->getCountryData($slug);

        $confirmed = end($data['confirmed']);
        $recovered = end($data['recovered']);
        $deaths = end($data['deaths']);

        return (new CountryData())
            ->setCountry($data['country'])
            ->setDate(\DateTime::createFromFormat(\DateTimeInterface::ATOM, $confirmed['Date'] ?? null))
            ->setConfirmed($confirmed['Cases'] ?? null)
            ->setRecovered($recovered['Cases'] ?? null)
            ->setDeaths($deaths['Cases'] ?? null);
    }
}
