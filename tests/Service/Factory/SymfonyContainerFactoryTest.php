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
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Toni Van de Voorde <toni@adlogix.eu>
 */
final class SymfonyContainerFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function construction_ThroughServiceManager_Instantiates()
    {
        $container = ServiceManagerFactory::getServiceManager()
            ->get('zf_symfony_container');

        $this->assertInstanceOf(ContainerInterface::class, $container);
    }

    /**
     * @test
     */
    public function getService_givenAValidPublicService_shouldReturnTheService()
    {
        /** @var ContainerInterface $container */
        $container = ServiceManagerFactory::getServiceManager()
            ->get('zf_symfony_container');

        $dummyTwo = $container->get(DummyTwo::class);

        $this->assertInstanceOf(DummyTwo::class, $dummyTwo);
    }
}
