# Zend Framework - Symfony DI Container
Zend Framework module to leverage the symfony dependency injection container

[![Build Status](https://travis-ci.org/adlogix/zf-symfony-container.svg?branch=master)](https://travis-ci.org/adlogix/zf-symfony-container)

# Installation

1. Install the module via composer by running:

```bash
composer require adlogix/zf-symfony-container:^0.3
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

Refer to the documentation of the [Symfony DI Component](https://symfony.com/doc/3.4/components/dependency_injection.html) for information on how to use the DI container.

#### Obtain a symfony defined service

Any existing symfony service will directly be available through the Service Manager of Zend:

```php
<?php

$service = $this->getServiceLocator()->get(\My\Public\Service::class);
```

#### Build a symfony defined service with a Zend service dependency

It will happen that you have to use a dependency which is already loaded into the Zend Service Manager. For example, if you are using the Doctrine Module and you
need to have the instance of the Entity Manager, you can leverage the ZendServiceProxyFactory class:

```yaml
services:

  _defaults:

    autowire: true      # Automatically injects dependencies in your services.
    autoconfigure: true # Automatically registers your services as commands, event subscribers, etc.
    public: false       # Allows optimizing the container by removing unused services; this also means
                        # fetching services directly from the container via $container->get() won't work.
                        # The best practice is to be explicit about your dependencies anyway.

  #
  # Define service that needs to be retrieved via the Zend Service Manager
  #

  Doctrine\ORM\EntityManagerInterface:
    factory: ['Adlogix\ZfSymfonyContainer\Service\Factory\ZendServiceProxyFactory', getService]
    arguments: ['@zend.container', 'doctrine.entitymanager.orm_default']
    class: Doctrine\ORM\EntityManagerInterface

```

With this configuration, and service defined with the symfony container requiring an instance of Doctrine\ORM\EntityManagerInterface will receive this from
the Zend Service Manager.

#### Obtain the symfony container instance

```php
<?php

$container = $this->getServiceLocator()->get('zf_symfony_container');
```

#### Use the Zend config as Symfony parameters
The module takes care of transforming all zend configurations into [Symfony parameters](https://symfony.com/doc/current/service_container/parameters.html) allowing you to immediately use the parameters in the service definition file:
```php
<?php
// global.php
return [
    'myconfig' => 'hello world' 
];
```
```yaml
services:
  Some\Service:
    arguments: ['%myconfig%']
```
When the Zend configuration contains deep level keys, the "keys" will be concatenated with a dot.
```php
<?php
// global.php
return [
    'deep' => [
        'level' => [
            'config' => 'hello world'            
        ]    
    ]    
];
```
```yaml
services:
  Some\Service:
    arguments: ['%deep.level.config%']
```
_Note: zend configurations using callables will be ignored and cannot be used!_ 