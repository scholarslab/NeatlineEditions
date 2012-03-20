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
     * Register routes.
     *
     * @param object $router The router.
     *
     * @return void.
     */
    public function defineRoutes($router)
    {

        // Public edition view.
        $router->addRoute(
            'neatlineEditions',
            new Zend_Controller_Router_Route(
                'neatline-editions/:slug',
                array(
                    'module'        => 'neatline-editions',
                    'controller'    => 'index',
                    'action'        => 'show'
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

        // Get exhibits.
        $exhibits = $this->_db->getTable('NeatlineExhibit')->findAll();

        // Insert tab.
        $tabs['Neatline Editions'] = __v()->partial(
            'items/_selectExhibit.php', array('exhibits' => $exhibits));

        return $tabs;

    }

}
