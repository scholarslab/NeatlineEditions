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
        'uninstall',
        'define_routes',
        'after_save_form_item'
    );

    private static $_filters = array(
        'admin_items_form_tabs'
    );

    /**
     * Get database, add hooks and filters.
     *
     * @return void
     */
    public function __construct()
    {

        // Get database and tables.
        $this->_db = get_db();
        $this->exhibitsTable = $this->_db->getTable('NeatlineExhibit');
        $this->editionsTable = $this->_db->getTable('NeatlineEdition');

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
     * Register routes.
     *
     * @param object $router The router.
     *
     * @return void.
     */
    public function defineRoutes($router)
    {

        // In-theme view.
        $router->addRoute(
            'neatlineEditionsInTheme',
            new Zend_Controller_Router_Route(
                'neatline-editions/:id',
                array(
                    'module'        => 'neatline-editions',
                    'controller'    => 'index',
                    'action'        => 'show'
                )
            )
        );

        // Fullscreen view.
        $router->addRoute(
            'neatlineEditionsFullScreen',
            new Zend_Controller_Router_Route(
                'neatline-editions/fullscreen/:id',
                array(
                    'module'        => 'neatline-editions',
                    'controller'    => 'index',
                    'action'        => 'fullscreen'
                )
            )
        );

    }

    /**
     * Process exhibit assignment on item add/edit.
     *
     * @param Item $record The item.
     * @param array $post The complete $_POST.
     *
     * @return void.
     */
    public function afterSaveFormItem($record, $post)
    {

        // Get exhibit id.
        $id = $post['exhibit_id'];

        // Check for a set exhibit value.
        if (is_numeric($id)) {
            // Get the exhibit, create or update edition.
            $exhibit = $this->exhibitsTable->find($id);
            $this->editionsTable->createOrUpdate($record, $exhibit);
        }

        // If there is an existing edition, delete.
        else {
            $edition = $this->editionsTable->findByItem($record);
            if ($edition) { $edition->delete(); }
        }

    }


    /**
     * Filter callbacks:
     */


    /**
     * Add tab to items add/edit.
     *
     * @param array $tabs Associative array with tab name => markup.
     *
     * @return array The tabs array with the Neatline Editions tab.
     */
    public function adminItemsFormTabs($tabs)
    {

        // Set edition to false by default.
        $edition = false;

        // Get item and exhibits.
        $exhibits = $this->exhibitsTable->findAll();
        $item = get_current_item();

        // Try to get existing edition.
        if (!is_null($item->id)) {
            $edition = $this->_db
                ->getTable('NeatlineEdition')
                ->findByItem($item);
        }

        // Insert tab.
        $tabs['Neatline Editions'] = __v()->partial(
            'items/_selectExhibit.php', array(
                'exhibits' => $exhibits,
                'edition' => $edition
            )
        );

        return $tabs;

    }

}
