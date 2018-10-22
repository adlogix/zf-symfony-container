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


use Symfony\Component\DependencyInjection\ContainerInterface;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Toni Van de Voorde <toni@adlogix.eu>
 */
final class SymfonyContainerAbstractFactory implements AbstractFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        /** @var ContainerInterface $sfContainer */
        $sfContainer = $serviceLocator->get('zf_symfony_container');

        return $sfContainer->has($requestedName);
    }

    /**
     * {@inheritdoc}
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        /** @var ContainerInterface $sfContainer */
        $sfContainer = $serviceLocator->get('zf_symfony_container');

        return $sfContainer->get($requestedName);
    }
}