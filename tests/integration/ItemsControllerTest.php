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
     * There should be a Neatline editions tab in the item add form.
     *
     * @return void.
     */
    public function testNeatlineEditionsItemAddTab()
    {

        // Create exhibits.
        $exhibit1 = $this->_createExhibit('Exhibit 1');
        $exhibit2 = $this->_createExhibit('Exhibit 2');

        // Hit item add.
        $this->dispatch('items/add');

        // Check for tab.
        $this->assertXpathContentContains(
            '//ul[@id="section-nav"]/li/a[@href="#neatline-editions-metadata"]',
            'Neatline Editions'
        );

        // Check for select and options.
        $this->assertXpath('//select[@id="exhibit-id"][@name="exhibit_id"]');
        $this->assertXpathContentContains(
            '//select[@id="exhibit-id"]/option[1]',
            'Select Below');
        $this->assertXpathContentContains(
            '//select[@id="exhibit-id"]/option[@value="' . $exhibit1->id . '"]',
            'Exhibit 1');
        $this->assertXpathContentContains(
            '//select[@id="exhibit-id"]/option[@value="' . $exhibit2->id . '"]',
            'Exhibit 2');

        // Create item.
        $item = new Item();
        $item->save();

        // Hit item edit.
        $this->dispatch('items/edit/' . $item->id);

    }

    /**
     * There should be a Neatline editions tab in the item edit form.
     *
     * @return void.
     */
    public function testNeatlineEditionsItemEditTab()
    {

        // Create exhibits.
        $exhibit1 = $this->_createExhibit('Exhibit 1');
        $exhibit2 = $this->_createExhibit('Exhibit 2');

        // Create item.
        $item = new Item();
        $item->save();

        // Hit item edit.
        $this->dispatch('items/edit/' . $item->id);

        // Check for tab.
        $this->assertXpathContentContains(
            '//ul[@id="section-nav"]/li/a[@href="#neatline-editions-metadata"]',
            'Neatline Editions'
        );

        // Check for select and options.
        $this->assertXpath('//select[@id="exhibit-id"][@name="exhibit_id"]');
        $this->assertXpathContentContains(
            '//select[@id="exhibit-id"]/option[1]',
            'Select Below');
        $this->assertXpathContentContains(
            '//select[@id="exhibit-id"]/option[@value="' . $exhibit1->id . '"]',
            'Exhibit 1');
        $this->assertXpathContentContains(
            '//select[@id="exhibit-id"]/option[@value="' . $exhibit2->id . '"]',
            'Exhibit 2');

    }

    /**
     * When an edition exists, the dropdown select should default to the
     * previously selected exhibit.
     *
     * @return void.
     */
    public function testNeatlineEditionsItemEditSelect()
    {

        // Create exhibits.
        $exhibit1 = $this->_createExhibit('Exhibit 1');
        $exhibit2 = $this->_createExhibit('Exhibit 2');

        // Create item.
        $item = new Item();
        $item->save();

        // Create edition with exhibit1.
        $this->_createEdition($item, $exhibit1);

        // Hit item edit.
        $this->dispatch('items/edit/' . $item->id);

        // Check for "selected".
        $this->assertXpathContentContains(
            '//select[@id="exhibit-id"]/option[1]',
            'Select Below');
        $this->assertXpathContentContains(
            '//select[@id="exhibit-id"]/option[@value="'
            . $exhibit1->id .'"][@selected="selected"]',
            'Exhibit 1');
        $this->assertXpathContentContains(
            '//select[@id="exhibit-id"]/option[@value="'
            . $exhibit2->id . '"]',
            'Exhibit 2');
        $this->assertNotXpathContentContains(
            '//select[@id="exhibit-id"]/option[@value="'
            . $exhibit2->id . '"][@selected="selected"]',
            'Exhibit 2');

    }

}
