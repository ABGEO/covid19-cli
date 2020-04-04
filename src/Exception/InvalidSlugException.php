<?php

/*
 * This file is part of the abgeo/covid19-cli package.
 *
 * (c) Temuri Takalandze <me@abgeo.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ABGEO\COVID\Exception;

use Throwable;

/**
 * Class InvalidSlugException.
 *
 * @categhory Exception
 * @package   ABGEO\COVID
 */
class InvalidSlugException extends \Exception
{
    public const CODE = 1;

    /**
     * InvalidSlugException constructor.
     *
     * @param string $slug        Invalid slug.
     * @param Throwable $previous [optional] The previous throwable used for the exception chaining.
     */
    public function __construct(string $slug, Throwable $previous = null)
    {
        parent::__construct('Slug '.$slug.' is invalid!', self::CODE, $previous);
    }
}
