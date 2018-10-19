# Zend Framework - Symfony DI Container
Zend Framework module to leverage the symfony dependency injection container

[![Build Status](https://travis-ci.org/adlogix/zf-symfony-container.svg?branch=master)](https://travis-ci.org/adlogix/zf-symfony-container)

# Installation

1. Install the module via composer by running:

```bash
composer require adlogix/zf-symfony-container:^0.1
```

2. Add the `Adlogix\ZfSymfonyContainer` module to the module section of your `config/application.config.php`

# Configuration

Symfony Container parameters can be defined in the application configurations:

```php
<?php
return [

    'zf_symfony_container' => [

        // directory where to look for the service container configurations (e.g. config/services.yaml)
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
];
```

# Usage

To retrieve the symfony container a zend controller:

```php
<?php

$container = $this->getServiceLocator()->get('zf_symfony_container');
```

Refer to the documentation of the [Symfony DI Component](https://symfony.com/doc/3.4/components/dependency_injection.html) for more information on how to use the container.
