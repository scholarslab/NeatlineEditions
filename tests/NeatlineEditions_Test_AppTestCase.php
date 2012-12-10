<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * Testing helper class.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

require_once '../NeatlineEditionsPlugin.php';
require_once '../../Neatline/NeatlinePlugin.php';

class NLEditions_Test_AppTestCase extends Omeka_Test_AppTestCase
{


    private $_dbHelper;


    /**
     * Spin up the plugins and prepare the database.
     */
    public function setUpPlugin()
    {

        parent::setUp();

        // Authenticate starting user.
        $this->user = $this->db->getTable('User')->find(1);
        $this->_authenticateUser($this->user);

        // Neatline broker.
        $neatline_broker = get_plugin_broker();
        $neatline_broker->setCurrentPluginDirName('Neatline');
        new NeatlinePlugin;

        // Neatline helper.
        $neatline_helper = new Omeka_Test_Helper_Plugin;
        $neatline_helper->setUp('Neatline');

        // Editions broker.
        $editions_broker = get_plugin_broker();
        $editions_broker->setCurrentPluginDirName('NeatlineEditions');
        new NeatlineEditionsPlugin;

        // Editions helper.
        $editions_helper = new Omeka_Test_Helper_Plugin;
        $editions_helper->setUp('NeatlineEditions');

        // Database helper.
        $this->_dbHelper = Omeka_Test_Helper_Db::factory($this->core);

    }


    /**
     * Create a Neatline exhibit.
     *
     * @return Omeka_record $neatline The exhibit.
     */
    public function _createExhibit(
        $name = 'Test Exhibit',
        $slug = 'test-exhibit',
        $public = 1,
        $is_map = 1,
        $is_timeline = 1,
        $is_items = 1
    )
    {

        $exhibit = new NeatlineExhibit();
        $exhibit->name = $name;
        $exhibit->slug = $slug;
        $exhibit->public = $public;
        $exhibit->is_map = $is_map;
        $exhibit->is_timeline = $is_timeline;
        $exhibit->is_items = $is_items;
        $exhibit->save();

        return $exhibit;

    }


    /**
     * Create a Neatline edition.
     *
     * @param Omeka_record $item The item record.
     * @param Omeka_record $exhibit The exhibit record.
     * @return Omeka_record $neatline The exhibit.
     */
    public function _createEdition($item = null, $exhibit = null)
    {

        // If null, create item.
        if (is_null($item)) {
            $item = new Item();
        }

        // If null, create exhibit.
        if (is_null($exhibit)) {
            $exhibit = $this->_createExhibit();
        }

        // Create edition.
        $edition = new NeatlineEdition($item, $exhibit);
        $edition->save();

        return $edition;

    }


    /**
     * Create an Item.
     *
     * @return Omeka_record $item The item.
     */
    public function _createItem()
    {
        $item = new Item;
        $item->save();
        return $item;
    }


    /**
     * Create an Item of item type metadata Document.
     *
     * @return Omeka_record $item The item.
     */
    public function _createDocumentItem()
    {

        // Get item type table.
        $_db = get_db();
        $itemTypeTable = $_db->getTable('ItemType');

        // Get Document item type.
        $documentType = $itemTypeTable->findByName('Document');

        $item = new Item;
        $item->item_type_id = $documentType->id;
        $item->save();

        return $item;

    }


    /**
     * Create an element text for an item.
     *
     * @param Omeka_record $item The item.
     * @param string $elementSet The element set.
     * @param string $elementName The element name.
     * @param string $value The value for the text.
     * @return Omeka_record $text The new text.
     */
    public function _createElementText(
        $item, $elementSet, $elementName, $value)
    {

        // Get tables.
        $_db = get_db();
        $elementTable = $_db->getTable('Element');
        $elementTextTable = $_db->getTable('ElementText');
        $recordTypeTable = $_db->getTable('RecordType');

        // Fetch element record.
        $element = $elementTable->findByElementSetNameAndElementName(
            $elementSet, $elementName);

        // Get item type id.
        $itemTypeId = $recordTypeTable->findIdFromName('Item');

        $text = new ElementText;
        $text->record_id = $item->id;
        $text->record_type_id = $itemTypeId;
        $text->element_id = $element->id;
        $text->text = $value;
        $text->save();

        return $text;

    }


}
