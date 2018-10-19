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

use Adlogix\ZfSymfonyContainer\Options\Configuration;
use Adlogix\ZfSymfonyContainer\Test\Util\ServiceManagerFactory;
use PHPUnit\Framework\TestCase;

/**
 * @author Toni Van de Voorde <toni@adlogix.eu>
 */
final class SymfonyContainerConfigFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function construction_ThroughServiceManager_Instantiates()
    {
        $config = ServiceManagerFactory::getServiceManager()
            ->get('zf_symfony_container_config');

        $this->assertInstanceOf(Configuration::class, $config);
    }
}
