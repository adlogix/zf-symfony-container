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
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Toni Van de Voorde <toni@adlogix.eu>
 */
final class SymfonyContainerFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, SymfonyContainerFactory::class);
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var Configuration $configuration */
        $configuration = $container->get('zf_symfony_container_config');

        $cachedFilePath = $configuration->getCacheDir() . DIRECTORY_SEPARATOR . $configuration->getCacheFilename();

        $containerConfigCache = new ConfigCache($cachedFilePath, $configuration->isDebug());

        if (!$containerConfigCache->isFresh()) {
            $containerBuilder = new ContainerBuilder();
            $loader = new YamlFileLoader($containerBuilder, new FileLocator([$configuration->getConfigDir()]));
            $loader->load('services.yaml');
            $containerBuilder->compile();

            $dumper = new PhpDumper($containerBuilder);
            $containerConfigCache->write(
                $dumper->dump([
                    'class'     => $configuration->getCacheClassname(),
                    'namespace' => $configuration->getCacheNamespace()
                ]),
                $containerBuilder->getResources()
            );
        }

        require_once $cachedFilePath;

        return new \Adlogix\ZfSymfonyContainer\DependencyInjection\CachedContainer();
    }
}
