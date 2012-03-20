<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Integration tests for additions to item add/edit workflow.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */

class NLEditions_ItemsControllerTest extends NLEditions_Test_AppTestCase
{

    /**
     * Install the plugin.
     *
     * @return void.
     */
    public function setUp()
    {
        parent::setUp();
        $this->setUpPlugin();
    }

    /**
     * There should be a Neatline editions tab in the item add/edit forms.
     *
     * @return void.
     */
    public function testNeatlineEditionsTab()
    {

        // Create exhibits.

        // Hit item add.
        $this->dispatch('items/add');

        // Check for tab.
        $this->assertQueryContentContains(
            '#section-nav li a',
            'Neatline Editions'
        );

        // Check for select.

        // Create item.
        $item = new Item();
        $item->save();

        // Hit item edit.
        $this->dispatch('items/edit/' . $item->id);

    }

}
