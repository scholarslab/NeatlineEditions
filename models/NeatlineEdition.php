<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * Edition row class.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

class NeatlineEdition extends Omeka_record
{


    /**
     * The id of the parent exhibit.
     * int(10) unsigned NULL
     */
    public $exhibit_id;

    /**
     * The id of the parent item.
     * int(10) unsigned NULL
     */
    public $item_id;


    /**
     * Set keys.
     *
     * @param Omeka_record $item The item record.
     * @param Omeka_record $exhibit The exhibit record.
     */
    public function __construct($item = null, $exhibit = null)
    {

        parent::__construct();

        // If defined, set the item key.
        if (!is_null($item)) {
            $this->item_id = $item->id;
        }

        // If defined, set the exhibit key.
        if (!is_null($exhibit)) {
            $this->exhibit_id = $exhibit->id;
        }

    }


    /**
     * Get the parent exhibit.
     *
     * @return NeatlineExhibit The exhibit.
     */
    public function getExhibit()
    {
        $_exhibitsTable = $this->getTable('NeatlineExhibit');
        return $_exhibitsTable->find($this->exhibit_id);
    }


    /**
     * Get the parent item.
     *
     * @return Item The item.
     */
    public function getItem()
    {
        $_itemsTable = $this->getTable('Item');
        return $_itemsTable->find($this->item_id);
    }


    /**
     * Get the document.
     *
     * @return string $document The document.
     */
    public function getDocumentMarkup()
    {
        return neatline_getItemMetadata($this->getItem(),
            'Item Type Metadata', 'Text');
    }


}
