<?php

/*
 * This file is part of the abgeo/covid19-cli package.
 *
 * (c) Temuri Takalandze <me@abgeo.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ABGEO\COVID\Model;

/**
 * Class CountryData.
 *
 * @categhory Model
 * @package   ABGEO\COVID
 */
class CountryData
{
    /**
     * @var string
     */
    private $country;

    /**
     * @var \DateTimeInterface
     */
    private $date;

    /**
     * @var int
     */
    private $confirmed;

    /**
     * @var int
     */
    private $recovered;

    /**
     * @var int
     */
    private $deaths;

    /**
     * Get Country Data Country.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set Country Data Country.
     *
     * @param string $country Country.
     *
     * @return CountryData
     */
    public function setCountry(?string $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get Country Data Date.
     *
     * @return \DateTimeInterface
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set Country Data Date.
     *
     * @param \DateTimeInterface $date Date.
     *
     * @return CountryData
     */
    public function setDate(?\DateTimeInterface $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get Country Data Confirmed Cases Count.
     *
     * @return int
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * Set Country Data Confirmed Cases Count.
     *
     * @param int $confirmed Data Confirmed Cases Count.
     *
     * @return CountryData
     */
    public function setConfirmed(?int $confirmed)
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    /**
     * Get Country Data Recovered Cases Count.
     *
     * @return int
     */
    public function getRecovered()
    {
        return $this->recovered;
    }

    /**
     * Set Country Data Recovered Cases Count.
     *
     * @param int $recovered Recovered Cases Count.
     *
     * @return CountryData
     */
    public function setRecovered(?int $recovered)
    {
        $this->recovered = $recovered;

        return $this;
    }

    /**
     * Get Country Data Death Cases Count.
     *
     * @return int
     */
    public function getDeaths()
    {
        return $this->deaths;
    }

    /**
     * Set Country Data Death Cases Count.
     *
     * @param int $deaths Death Cases Count.
     *
     * @return CountryData
     */
    public function setDeaths(?int $deaths)
    {
        $this->deaths = $deaths;

        return $this;
    }
}
