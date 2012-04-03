<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Public views controller.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */

class NeatlineEditions_IndexController extends Omeka_Controller_Action
{

    /**
     * Get tables.
     *
     * @return void
     */
    public function init()
    {
        $this->_items = $this->getTable('Item');
        $this->_exhibits = $this->getTable('NeatlineExhibit');
        $this->_editions = $this->getTable('NeatlineEdition');

        // Get exhibit and document markup.
        $item = $this->_items->find($this->_request->id);
        $edition = $this->_editions->findByItem($item);
        $exhibit = $edition->getExhibit();
        $document = $edition->getDocumentMarkup();

        // Push records.
        $this->view->exhibit = $exhibit;
        $this->view->edition = $edition;
        $this->view->document = $document;
    }

    /**
     * In-theme view.
     *
     * @return void
     */
    public function showAction()
    {

    }

    /**
     * Fullscreen view.
     *
     * @return void
     */
    public function fullscreenAction()
    {

    }

}
