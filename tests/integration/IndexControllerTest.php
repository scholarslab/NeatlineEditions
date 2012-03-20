<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Index controller integration tests.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */

class NeatlineEditions_IndexControllerTest extends NeatlineEditions_Test_AppTestCase
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
     * Index should redirect to the browse action.
     *
     * @return void.
     */
    public function testIndexRedirect()
    {

        $this->dispatch('neatline-editions');
        $this->assertModule('neatline-editions');
        $this->assertController('index');
        $this->assertAction('browse');

    }

    /**
     * The browse view should show a link to add a new edition.
     *
     * @return void.
     */
    public function testBrowseMarkup()
    {

        $this->dispatch('neatline-editions');

        // There should be a 'Create Neatline' button.
        $this->assertQueryContentContains(
            'a.add',
            'Create an Edition'
        );

    }

}
