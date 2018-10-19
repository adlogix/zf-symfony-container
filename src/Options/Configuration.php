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

namespace Adlogix\ZfSymfonyContainer\Options;

/**
 * @author Toni Van de Voorde <toni@adlogix.eu>
 */
final class Configuration
{
    private $configDir = 'config';

    private $cacheDir = 'data/ZfSymfonyContainer';

    private $cacheFilename = 'zf_symfony_container_cache';

    private $cacheClassname = 'CachedContainer';

    private $cacheNamespace = 'Adlogix\ZfSymfonyContainer\DependencyInjection';

    private $debug = false;

    /**
     * @return string
     */
    public function getCacheFilename()
    {
        return $this->cacheFilename;
    }

    /**
     * @param string $cacheFilename
     */
    public function setCacheFilename($cacheFilename)
    {
        $this->cacheFilename = (string)$cacheFilename;
    }

    /**
     * @return string
     */
    public function getConfigDir()
    {
        return $this->configDir;
    }

    /**
     * @param string $configDir
     */
    public function setConfigDir($configDir)
    {
        $this->configDir = (string)$configDir;
    }

    /**
     * @return string
     */
    public function getCacheDir()
    {
        return $this->cacheDir;
    }

    /**
     * @param string $cacheDir
     */
    public function setCacheDir($cacheDir)
    {
        $this->cacheDir = (string)$cacheDir;
    }

    /**
     * @return bool
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * @param bool $debug
     */
    public function setDebug($debug)
    {
        $this->debug = (bool)$debug;
    }

    /**
     * @return string
     */
    public function getCacheClassname()
    {
        return $this->cacheClassname;
    }

    /**
     * @param string $cacheClassname
     */
    public function setCacheClassname($cacheClassname)
    {
        $this->cacheClassname = $cacheClassname;
    }

    /**
     * @return string
     */
    public function getCacheNamespace()
    {
        return $this->cacheNamespace;
    }

    /**
     * @param string $cacheNamespace
     */
    public function setCacheNamespace($cacheNamespace)
    {
        $this->cacheNamespace = $cacheNamespace;
    }

    /**
     * @param array $options
     *
     * @return Configuration
     */
    public static function fromOptions(array $options)
    {
        $self = new static();

        if (isset($options['config_dir'])) {
            $self->setConfigDir($options['config_dir']);
        }

        if (isset($options['cache'])) {
            $cacheOptions = $options['cache'];

            if (isset($cacheOptions['dir'])) {
                $self->setCacheDir($cacheOptions['dir']);
            }

            if (isset($cacheOptions['filename'])) {
                $self->setCacheFilename($cacheOptions['filename']);
            }

            if (isset($cacheOptions['classname'])) {
                $self->setCacheClassname($cacheOptions['classname']);
            }

            if (isset($cacheOptions['namespace'])) {
                $self->setCacheNamespace($cacheOptions['namespace']);
            }

            if (isset($cacheOptions['debug'])) {
                $self->setDebug($cacheOptions['debug']);
            }
        }

        return $self;
    }
}
