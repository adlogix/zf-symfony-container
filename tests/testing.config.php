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

return [

    'zf_symfony_container' => [

        // directory where to look for the service container configurations like services.yaml
        'config_dir' => 'tests/sandbox/config',

        // Caching options
        'cache' => [

            // directory where the cached container will be stored
            'dir' => 'tests/sandbox/data/ZfSymfonyContainer',

            // enable in dev mode
            'debug' => true

        ],
    ],
];
