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
use Adlogix\ZfSymfonyContainer\ParameterBag\ZendFrameworkParameterBag;
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
        return $this($serviceLocator, SymfonyContainerFactory::class, $serviceLocator->get('config'));
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $zfContainer, $requestedName, array $config = null)
    {
        /** @var Configuration $configuration */
        $configuration = $zfContainer->get('zf_symfony_container_config');

        $cachedFilePath = $configuration->getCacheDir() . DIRECTORY_SEPARATOR . $configuration->getCacheFilename();

        $containerConfigCache = new ConfigCache($cachedFilePath, $configuration->isDebug());

        if (!$containerConfigCache->isFresh()) {
            $containerBuilder = new ContainerBuilder(new ZendFrameworkParameterBag($config));
            $loader = new YamlFileLoader($containerBuilder, new FileLocator([$configuration->getConfigDir()]));
            $loader->load('services.yaml');

            // Register a synthetic service placement. This is where we are going to inject the zend service manager.
            // This is important so we can make use of the ZendServiceProxyFactory
            $containerBuilder
                ->register('zend.container')
                ->setSynthetic(true);

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

        $cachedContainer = new \Adlogix\ZfSymfonyContainer\DependencyInjection\CachedContainer();
        $cachedContainer->set('zend.container', $zfContainer);

        return $cachedContainer;
    }
}
