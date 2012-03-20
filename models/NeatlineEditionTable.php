<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Table class for Neatline editions.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */

class NeatlineDataRecordTable extends Omeka_Db_Table
{

    /**
     * For a given item, try to find an existing edition record for the item.
     * If one exists, update the exhibit key with the id of the passed exhibit.
     * If a record does not already exist for the item, create a new record.
     *
     * @param Omeka_record $item The item.
     * @param Omeka_record $exhibit The exhibit.
     *
     * @return void.
     */
    public function createOrUpdate($item, $exhibit)
    {


    }

}
