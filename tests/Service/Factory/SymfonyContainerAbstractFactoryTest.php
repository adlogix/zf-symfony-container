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

namespace Adlogix\ZfSymfonyContainer\Test\Service\Factory;

use Adlogix\ZfSymfonyContainer\Test\Fixtures\DummyTwo;
use Adlogix\ZfSymfonyContainer\Test\Util\ServiceManagerFactory;
use PHPUnit\Framework\TestCase;

final class SymfonyContainerAbstractFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function getService_directlyThroughServiceLocator_shouldReturnInstance()
    {
        $dummyTwo = ServiceManagerFactory::getServiceManager()
            ->get(DummyTwo::class);

        $this->assertInstanceOf(DummyTwo::class, $dummyTwo);
    }
}
