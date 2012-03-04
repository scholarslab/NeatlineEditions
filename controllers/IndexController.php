<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Admin controller.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      Bethany Nowviskie <bethany@virginia.edu>
 * @author      Adam Soroka <ajs6f@virginia.edu>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */

class Neatline_IndexController extends Omeka_Controller_Action
{

    /**
     * Get tables.
     *
     * @return void
     */
    public function init()
    {
        $this->_editions = $this->getTable('NeatlineEdition');
    }

    /**
     * Redirect index route to browse.
     *
     * @return void
     */
    public function indexAction()
    {
        $this->redirect->goto('browse');
    }

    /**
     * Show editions.
     *
     * @return void
     */
    public function browseAction()
    {

    }

    /**
     * Create an edition.
     *
     * @return void
     */
    public function addAction()
    {

    }

    /**
     * Edit an edition.
     *
     * @return void
     */
    public function editAction()
    {

    }

    /**
     * Delete an edition.
     *
     * @return void
     */
    public function deleteAction()
    {

    }

}
