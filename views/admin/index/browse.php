<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * Browse editions.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

?>

<?php head(); ?>

<?php echo $this->partial('index/_header.php', array(
    'subtitle' => 'Browse Editions'
)); ?>

<div id="primary">
    <?php echo flash(); ?>
</div>

<?php foot(); ?>
