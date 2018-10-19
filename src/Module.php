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

namespace Adlogix\ZfSymfonyContainer;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * @author Toni Van de Voorde <toni@adlogix.eu>
 */
final class Module implements ConfigProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
