<?php
/**
 *
 */

namespace Adlogix\ZfSymfonyContainer\Test\ParameterBag;

use Adlogix\ZfSymfonyContainer\ParameterBag\ZendFrameworkParameterBag;

/**
 * @author Laurent De Coninck <lau.deconinck@gmail.com>
 */
class ZendFrameworkParameterBagTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @param array $parameters
     *
     * @return ZendFrameworkParameterBag
     */
    private function createParameterBag(array $parameters)
    {
        return new ZendFrameworkParameterBag($parameters);
    }

    /**
     * @test
     */
    public function add_WithValues_Success()
    {
        $data = [
            'key'        => 'value1',
            'anotherKey' => '%value1%',
        ];

        $parameterBag = $this->createParameterBag($data);

        $this->assertEquals('value1', $parameterBag->get('key'));
        $this->assertEquals('%%value1%%', $parameterBag->get('anotherKey'));
    }

    /**
     * @test
     */
    public function add_WithTables_Success()
    {
        $data = [
            'key'         => 'value1',
            'associative' => [
                'a' => 1,
                'c' => 2,
                'd' => 3,
            ],
            'index' => [
                'A',
                'B',
                'C',
            ],
            'arrayOfArray' => [
                'a' => [
                    'A',
                    'B',
                    'C',
                ],
            ],
        ];

        $parameterBag = $this->createParameterBag($data);
        $this->assertEquals('value1', $parameterBag->get('key'));
        $this->assertEquals(2, $parameterBag->get('associative.c'));
        $this->assertEquals('B', $parameterBag->get('index.1'));
        $this->assertEquals('B', $parameterBag->get('arrayOfArray.a.1'));
    }

    /**
     * @test
     */
    public function add_WithCallable_Skipped()
    {
        $data = [
            'callback' => function () {
                return true;
            },
        ];

        $parameterBag = $this->createParameterBag($data);

        $this->assertFalse($parameterBag->has('callback'));
    }
}
