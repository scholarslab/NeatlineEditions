<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * Public views controller.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

class NeatlineEditions_IndexController extends Omeka_Controller_Action
{

    /**
     * Get tables, populate views.
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
     */
    public function showAction()
    {

    }

    /**
     * Fullscreen view.
     */
    public function fullscreenAction()
    {

    }

}
