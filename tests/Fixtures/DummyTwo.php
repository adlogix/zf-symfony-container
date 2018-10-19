<?php
/*
 * This file is part of the Adlogix package.
 *
 * (c) Allan Segebarth <allan@adlogix.eu>
 * (c) Jean-Jacques Courtens <jjc@adlogix.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Adlogix\ZfSymfonyContainer\Test\Fixtures;

/**
 * @author Toni Van de Voorde <toni@adlogix.eu>
 */
final class DummyTwo
{
    /**
     * @var DummyOne
     */
    private $dummyOne;

    /**
     * @param DummyOne $dummyOne
     */
    public function __construct(DummyOne $dummyOne)
    {
        $this->dummyOne = $dummyOne;
    }
}
