<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Plugin runner.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */


class NeatlineEditionsPlugin
{

    // Hooks.
    private static $_hooks = array(
        'install',
        'uninstall'
    );

    private static $_filters = array(
        'admin_navigation_main'
    );

    /**
     * Get database, add hooks and filters.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_db = get_db();
        self::addHooksAndFilters();
    }

    /**
     * Iterate over hooks and filters, define callbacks.
     *
     * @return void
     */
    public function addHooksAndFilters()
    {

        foreach (self::$_hooks as $hookName) {
            $functionName = Inflector::variablize($hookName);
            add_plugin_hook($hookName, array($this, $functionName));
        }

        foreach (self::$_filters as $filterName) {
            $functionName = Inflector::variablize($filterName);
            add_filter($filterName, array($this, $functionName));
        }

    }


    /**
     * Hook callbacks:
     */


    /**
     * Install.
     *
     * @return void.
     */
    public function install()
    {

        // Editions table.
        $sql = "CREATE TABLE IF NOT EXISTS `{$this->_db->prefix}neatline_editions` (
                `id`              int(10) unsigned not null auto_increment,
                `exhibit_id`      int(10) unsigned NULL,
                `item_id`         int(10) unsigned NULL,
                 PRIMARY KEY (`id`)
               ) ENGINE=innodb DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

        $this->_db->query($sql);

    }

    /**
     * Uninstall.
     *
     * @return void.
     */
    public function uninstall()
    {

        // Drop the editions table.
        $sql = "DROP TABLE IF EXISTS `{$this->_db->prefix}neatline_editions`";
        $this->_db->query($sql);

    }

    /**
     * Filter callbacks:
     */

    /**
     * Add tab to admin menu.
     *
     * @param array $tabs This is an array of label => URI pairs.
     *
     * @return array The tabs array with the Neatline Maps tab.
     */
    public function adminNavigationMain($tabs)
    {
        $tabs['Neatline Editions'] = uri('neatline-editions');
        return $tabs;
    }

}
