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

use ABGEO\COVID\Exception\InvalidSlugException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class APIService.
 *
 * @categhory Service
 * @package   ABGEO\COVID
 */
class APIService
{
    private const API = 'https://api.covid19api.com';

    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client(
            [
                'base_uri' => self::API,
            ]
        );
    }

    public function getCountries()
    {
        try {
            $response = $this->client->get('countries');

            return json_decode($response->getBody()->getContents(), 1);
        } catch (GuzzleException $e) {
        }

        return [];
    }

    /**
     * @param string $slug
     * @return array
     * @throws InvalidSlugException
     */
    public function getCountryData(string $slug)
    {
        $country = null;
        $baseUrl = 'country/'.$slug.'/status';
        $countryData = array_filter(
            $this->getCountries(),
            static function ($data) use ($slug) {
                return $slug === $data['Slug'];
            }
        );

        if (empty($countryData)) {
            throw new InvalidSlugException($slug);
        }

        $countryData = end($countryData);
        $country = $countryData['Country'];

        try {
            $confirmedResponse = $this->client->get($baseUrl.'/confirmed/live');
            $recoveredResponse = $this->client->get($baseUrl.'/recovered/live');
            $deathsResponse = $this->client->get($baseUrl.'/deaths/live');

            $confirmed = json_decode($confirmedResponse->getBody()->getContents(), 1);
            $recovered = json_decode($recoveredResponse->getBody()->getContents(), 1);
            $deaths = json_decode($deathsResponse->getBody()->getContents(), 1);

            return compact('country', 'confirmed', 'recovered', 'deaths');
        } catch (GuzzleException $e) {
        }

        return [
            'country' => null,
            'confirmed' => [],
            'recovered' => [],
            'deaths' => [],
        ];
    }
}
