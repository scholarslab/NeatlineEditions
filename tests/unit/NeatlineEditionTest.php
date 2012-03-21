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

class NLEditions_NeatlineEditionTest extends NLEditions_Test_AppTestCase
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
     * Test get and set on columns.
     *
     * @return void.
     */
    public function testAttributeAccess()
    {

        // Create a record.
        $edition = new NeatlineEdition();

        // Set.
        $edition->exhibit_id = 1;
        $edition->item_id = 1;
        $edition->save();

        // Re-get the edition object.
        $edition = $this->editionsTable->find($edition->id);

        // Get.
        $this->assertEquals($edition->exhibit_id, 1);
        $this->assertEquals($edition->item_id, 1);

    }

    /**
     * Test foreign key assignments when item and exhibit records are passed
     * on instantiation.
     *
     * @return void.
     */
    public function testConstructKeyAssignments()
    {

        // Create item and exhibit.
        $item = $this->_createItem();
        $exhibit = $this->_createExhibit();

        // Create a record.
        $edition = new NeatlineEdition($item, $exhibit);

        // Check.
        $this->assertEquals($edition->exhibit_id, $exhibit->id);
        $this->assertEquals($edition->item_id, $item->id);

    }

    /**
     * getExhibit() should return the parent exhibit.
     *
     * @return void.
     */
    public function testGetExhibit()
    {

        // Create item, exhibit, and edition.
        $item = $this->_createItem();
        $exhibit = $this->_createExhibit();
        $edition = $this->_createEdition($item, $exhibit);

        // Check ids.
        $this->assertEquals($edition->getExhibit()->id, $exhibit->id);

    }

    /**
     * getItem() should return the parent item.
     *
     * @return void.
     */
    public function testGetItem()
    {

        // Create item, exhibit, and edition.
        $item = $this->_createItem();
        $exhibit = $this->_createExhibit();
        $edition = $this->_createEdition($item, $exhibit);

        // Check ids.
        $this->assertEquals($edition->getItem()->id, $item->id);

    }

    /**
     * getDocumentMarkup() should return the document text.
     *
     * @return void.
     */
    public function testGetDocumentMarkup()
    {

        // Create item, exhibit, and edition.
        $item = $this->_createDocumentItem();
        $exhibit = $this->_createExhibit();
        $edition = $this->_createEdition($item, $exhibit);

        // Create "Text" element text.
        $this->_createElementText($item, 'Item Type Metadata', 'Text', 'markup');
        $this->assertEquals($edition->getDocumentMarkup(), 'markup');

    }

}
