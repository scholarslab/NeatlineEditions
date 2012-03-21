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
        $this->setUpPlugin();
        $this->editionsTable = $this->db->getTable('NeatlineEdition');
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
    public function testItemEditTab()
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
    public function testItemEditSelect()
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

    /**
     * When an item is added and an exhibit is specified, a new edition
     * should be created.
     *
     * @return void.
     */
    public function testEditionCreationOnItemAdd()
    {

        // Create exhibit.
        $exhibit = $this->_createExhibit('Exhibit 1');

        // Get starting count.
        $count = $this->editionsTable->count();

        // Set exhibit id.
        $this->request->setMethod('POST')
            ->setPost(array(
                'public' => 1,
                'featured' => 0,
                'Elements' => array(),
                'order' => array(),
                'exhibit_id' => $exhibit->id
            )
        );

        // Hit item edit.
        $this->dispatch('items/add');

        // +1 editions.
        $this->assertEquals($this->editionsTable->count(), $count+1);

    }

    /**
     * When an item is edited and an exhibit is specified, a new edition
     * should be created.
     *
     * @return void.
     */
    public function testEditionCreationOnItemEdit()
    {

        // Create exhibit.
        $exhibit = $this->_createExhibit('Exhibit 1');

        // Create item.
        $item = new Item();
        $item->save();

        // Get starting count.
        $count = $this->editionsTable->count();

        // Set exhibit id.
        $this->request->setMethod('POST')
            ->setPost(array(
                'public' => 1,
                'featured' => 0,
                'Elements' => array(),
                'order' => array(),
                'exhibit_id' => $exhibit->id
            )
        );

        // Hit item edit.
        $this->dispatch('items/edit/' . $item->id);

        // +1 editions.
        $this->assertEquals($this->editionsTable->count(), $count+1);

        // Get the edition object.
        $edition = $this->editionsTable->find(1);
        $this->assertEquals($edition->item_id, $item->id);

    }

    /**
     * When an item with an edition is edited and the edition is set
     * to null, the edition should be deleted.
     *
     * @return void.
     */
    public function testEditionDeleteOnItemEdit()
    {

        // Create 2x item/exhibit/edition.
        $item1 = $this->_createItem();
        $item2 = $this->_createItem();
        $exhibit1 = $this->_createExhibit('Exhibit 1');
        $exhibit2 = $this->_createExhibit('Exhibit 2');
        $edition1 = $this->_createEdition($item1, $exhibit1);
        $edition2 = $this->_createEdition($item2, $exhibit2);

        // Get starting count.
        $count = $this->editionsTable->count();

        // Set exhibit id.
        $this->request->setMethod('POST')
            ->setPost(array(
                'public' => 1,
                'featured' => 0,
                'Elements' => array(),
                'order' => array(),
                'exhibit_id' => 'Select Below'
            )
        );

        // Hit item edit.
        $this->dispatch('items/edit/' . $item1->id);

        // -1 editions.
        $this->assertEquals($this->editionsTable->count(), $count-1);

        // Re-get the edition objects.
        $edition1 = $this->editionsTable->find($edition1->id);
        $edition2 = $this->editionsTable->find($edition2->id);
        $this->assertNull($edition1);
        $this->assertNotNull($edition2);

    }

}
