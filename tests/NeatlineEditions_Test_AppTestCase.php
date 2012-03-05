<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Testing helper class.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      Bethany Nowviskie <bethany@virginia.edu>
 * @author      Adam Soroka <ajs6f@virginia.edu>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2011 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */

require_once '../NeatlineEditionsPlugin.php';
require_once '../../Neatline/NeatlinePlugin.php';

class NeatlineEditions_Test_AppTestCase extends Omeka_Test_AppTestCase
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

}
