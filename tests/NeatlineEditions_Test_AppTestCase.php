<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Testing helper class.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2011 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */

require_once '../NeatlineEditionsPlugin.php';
require_once '../../Neatline/NeatlinePlugin.php';

class NLEditions_Test_AppTestCase extends Omeka_Test_AppTestCase
{

    private $_dbHelper;

    /**
     * Spin up the plugins and prepare the database.
     *
     * @return void.
     */
    public function setUpPlugin()
    {

        parent::setUp();

        $this->user = $this->db->getTable('User')->find(1);
        $this->_authenticateUser($this->user);

        // Set up Neatline.
        $neatline_plugin_broker = get_plugin_broker();
        $this->_addNeatlinePluginHooksAndFilters($neatline_plugin_broker, 'Neatline');
        $neatline_plugin_helper = new Omeka_Test_Helper_Plugin;
        $neatline_plugin_helper->setUp('Neatline');

        // Set up Neatline Editions.
        $neatline_editions_plugin_broker = get_plugin_broker();
        $this->_addNeatlineEditionsPluginHooksAndFilters($neatline_editions_plugin_broker, 'NeatlineEditions');
        $neatline_editions_plugin_helper = new Omeka_Test_Helper_Plugin;
        $neatline_editions_plugin_helper->setUp('NeatlineEditions');

        $this->_dbHelper = Omeka_Test_Helper_Db::factory($this->core);

    }

    /**
     * Install Neatline.
     *
     * @return void.
     */
    public function _addNeatlinePluginHooksAndFilters($plugin_broker, $plugin_name)
    {
        $plugin_broker->setCurrentPluginDirName($plugin_name);
        new NeatlinePlugin;
    }

    /**
     * Install Neatline Editions.
     *
     * @return void.
     */
    public function _addNeatlineEditionsPluginHooksAndFilters($plugin_broker, $plugin_name)
    {
        $plugin_broker->setCurrentPluginDirName($plugin_name);
        new NeatlineEditionsPlugin;
    }


    /**
     * Testing helpers.
     */


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
     *
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
     *
     * @return Omeka_record $text The new text.
     */
    public function _createElementText($item, $elementSet, $elementName, $value)
    {

        // Get tables.
        $_db = get_db();
        $elementTable = $_db->getTable('Element');
        $elementTextTable = $_db->getTable('ElementText');
        $recordTypeTable = $_db->getTable('RecordType');

        // Fetch element record and the item type id.
        $element = $elementTable->findByElementSetNameAndElementName($elementSet, $elementName);
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
