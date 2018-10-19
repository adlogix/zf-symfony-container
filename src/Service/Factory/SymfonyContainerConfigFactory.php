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

use Adlogix\ZfSymfonyContainer\Options\Configuration;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Toni Van de Voorde <toni@adlogix.eu>
 */
final class SymfonyContainerConfigFactory implements FactoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, SymfonyContainerConfigFactory::class);
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return Configuration::fromOptions($this->getOptions($container));
    }

    protected function getOptions(ContainerInterface $container)
    {
        $options = $container->get('config');
        return isset($options['zf_symfony_container']) ? $options['zf_symfony_container'] : [];
    }
}
