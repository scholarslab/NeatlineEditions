<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Edition row tests.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */

class NeatlineEditions_NeatlineEditionTest extends NeatlineEditions_Test_AppTestCase
{

    /**
     * Install the plugin.
     *
     * @return void.
     */
    public function setUp()
    {
        $this->setUpPlugin();
    }

    /**
     * Test get and set on columns.
     *
     * @return void.
     */
    public function testAttributeAccess()
    {

        // // Create a record.
        // $layer = new NeatlineBaseLayer();

        // // Set.
        // $layer->name = 'name';
        // $layer->save();

        // // Re-get the exhibit object.
        // $layer = $this->_layersTable->find($layer->id);

        // // Get.
        // $this->assertEquals($layer->name, 'name');

    }

}
