<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Edition row class.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */

class NeatlineEdition extends Omeka_record
{


    /**
     * Record attributes.
     */

    public $exhibit_id;
    public $item_id;


    /**
     * Set keys.
     *
     * @param Omeka_record $item The item record.
     * @param Omeka_record $exhibit The exhibit record.
     *
     * @return void.
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

}
