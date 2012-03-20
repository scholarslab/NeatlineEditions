<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Edition table tests.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */

class NLEditions_NeatlineEditionTableTest extends NLEditions_Test_AppTestCase
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
     * findByItem() should return the item record when one exists.
     *
     * @return void.
     */
    public function testFindByItemWhenRecordExists()
    {

        // Create item and exhibit.
        $item = $this->_createItem();
        $exhibit = $this->_createExhibit();

        // Create edition.
        $edition = new NeatlineEdition($item, $exhibit);
        $edition->save();

        // Get edition.
        $retrieved = $this->editionsTable->findByItem($item);

        // Check identity.
        $this->assertEquals($item->id, $retrieved->item_id);
        $this->assertEquals($exhibit->id, $retrieved->exhibit_id);

    }

    /**
     * findByItem() should false when a record does not exist.
     *
     * @return void.
     */
    public function testFindByItemWhenNoRecordExists()
    {

        // Create item.
        $item = $this->_createItem();

        // Try to get edition that does not exist.
        $retrieved = $this->editionsTable->findByItem($item);

        // Check false.
        $this->assertFalse($retrieved);

    }

    /**
     * createOrUpdate() should create a new record when one does not
     * already exist.
     *
     * @return void.
     */
    public function testCreateOrUpdateWhenNoRecordExists()
    {

        // Get starting count.
        $count = $this->editionsTable->count();

        // Create item and exhibit.
        $item = $this->_createItem();
        $exhibit = $this->_createExhibit();

        // Call with item without existing edition, re-get.
        $this->editionsTable->createOrUpdate($item, $exhibit);
        $newRecord = $this->editionsTable->findByItem($item);

        // 1 new record.
        $this->assertEquals($this->editionsTable->count(), $count+1);

        // Check keys.
        $this->assertEquals($newRecord->item_id, $item->id);
        $this->assertEquals($newRecord->exhibit_id, $exhibit->id);

    }

    /**
     * createOrUpdate() should update a record when one already exists.
     *
     * @return void.
     */
    public function testCreateOrUpdateWhenRecordExists()
    {

        // Create item and exhibits.
        $item = $this->_createItem();
        $exhibit1 = $this->_createExhibit();
        $exhibit2 = $this->_createExhibit();

        // Create edition.
        $edition = new NeatlineEdition($item, $exhibit1);
        $edition->save();

        // Get starting count.
        $count = $this->editionsTable->count();

        // Call with item and new exhibit.
        $this->editionsTable->createOrUpdate($item, $exhibit2);
        $updatedRecord = $this->editionsTable->findByItem($item);

        // 0 new records.
        $this->assertEquals($this->editionsTable->count(), $count);

        // Check keys.
        $this->assertEquals($updatedRecord->item_id, $item->id);
        $this->assertEquals($updatedRecord->exhibit_id, $exhibit2->id);

    }

}
