<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Test Runner.
 *
 * @package     omeka
 * @subpackage  neatlinemaps
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */

require_once 'NeatlineEditions_Test_AppTestCase.php';

class NeatlineEditions_AllTests extends PHPUnit_Framework_TestSuite
{

    /**
     * Aggregate the tests.
     *
     * @return NeatlineEditions_AllTests $suite The test suite.
     */
    public static function suite()
    {

        $suite = new NeatlineEditions_AllTests('Neatline Editions Tests');

        $collector = new PHPUnit_Runner_IncludePathTestCollector(
            array(
                dirname(__FILE__) . '/integration',
                dirname(__FILE__) . '/unit',
                dirname(__FILE__) . '/fixtures'
            )
        );

        $suite->addTestFiles($collector->collectTests());

        return $suite;

    }

}
