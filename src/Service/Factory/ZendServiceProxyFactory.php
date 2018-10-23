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

namespace Adlogix\ZfSymfonyContainer\Service\Factory;

use Interop\Container\ContainerInterface;

/**
 * A symfony container factory, allowing the load zend specific services. This is crucial when requiring to load
 * services that have been injected in the Zend service manager through e.g. third party modules.
 *
 * @author Toni Van de Voorde <toni@adlogix.eu>
 */
final class ZendServiceProxyFactory
{
    /**
     * @param ContainerInterface $container
     * @param string             $service
     *
     * @return mixed
     */
    public static function getService(ContainerInterface $container, $service)
    {
        return $container->get($service);
    }
}
