<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * Edition table class.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

class NeatlineEditionTable extends Omeka_Db_Table
{


    /**
     * Find an edition record for an item.
     *
     * @param Omeka_record $item The item.
     * @return Omeka_record|boolean The edition, if one exists.
     */
    public function findByItem($item)
    {

        $edition = $this->fetchObject(
            $this->getSelect()->where('item_id = ' . $item->id)
        );

        return $edition ? $edition : false;

    }


    /**
     * For a given item, try to find an existing edition record for the
     * item. If one exists, update the exhibit key with the id of the
     * passed exhibit. If a record does not already exist for the item,
     * create a new record.
     *
     * @param Omeka_record $item The item.
     * @param Omeka_record $exhibit The exhibit.
     * @return Omeka_record The new or updated edition.
     */
    public function createOrUpdate($item, $exhibit)
    {

        // Try to get existing record.
        $record = $this->findByItem($item);

        // If record exists, update.
        if ($record) { $record->exhibit_id = $exhibit->id; }

        // Otherwise, create a new record
        else { $record = new NeatlineEdition($item, $exhibit); }

        $record->save();
        return $record;

    }


}
