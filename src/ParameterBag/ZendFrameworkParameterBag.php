<?php
/**
 * This file is part of the Adlogix package.
 *
 * (c) Allan Segebarth <allan@adlogix.eu>
 * (c) Jean-Jacques Courtens <jjc@adlogix.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Adlogix\ZfSymfonyContainer\ParameterBag;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Translate the ZF config into Symfony parameters.
 *
 * @author Laurent De Coninck <laurent@adlogix.eu>
 */
class ZendFrameworkParameterBag extends ParameterBag
{
    /**
     * {@inheritdoc}
     */
    public function add(array $parameters)
    {
        foreach ($parameters as $key => $value) {
            if (is_array($value)) {
                $this->addChildren($key, $value);
                continue;
            }

            if (is_callable($value)) {
                //not supported by Symfony
                continue;
            }

            $this->set($key, str_replace('%', '%%', $value));
        }
    }

    /**
     * @param string $previousKey
     * @param array  $children
     */
    private function addChildren($previousKey, array $children)
    {
        $formattedChildren = [];

        foreach ($children as $key => $value) {
            $formattedChildren[$previousKey . '.' . $key] = $value;
        }

        $this->add($formattedChildren);
    }
}
