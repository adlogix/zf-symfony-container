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

use Adlogix\ZfSymfonyContainer\Service\Factory\SymfonyContainerAbstractFactory;
use Adlogix\ZfSymfonyContainer\Service\Factory\SymfonyContainerConfigFactory;
use Adlogix\ZfSymfonyContainer\Service\Factory\SymfonyContainerFactory;

return [

    'zf_symfony_container' => [

        // directory where to look for the service container configurations like services.yaml
        'config_dir' => 'config',

        // Caching options
        'cache' => [

            // directory where the cached container will be stored
            'dir' => 'data/ZfSymfonyContainer',

            // name of the file to generate the cached container class
            'filename' => 'zf_symfony_container_cache',

            // name of the class of the generated cached container
            'classname' => 'CachedContainer',

            // the namespace of the generated cached container
            'namespace' => 'Adlogix\ZfSymfonyContainer\DependencyInjection',

            // enable in dev mode
            'debug' => false
        ],


    ],

    'service_manager' => [

        'abstract_factories' => [
            SymfonyContainerAbstractFactory::class
        ],

        'factories' => [
            'zf_symfony_container'        => SymfonyContainerFactory::class,
            'zf_symfony_container_config' => SymfonyContainerConfigFactory::class,
        ]

    ]

];
