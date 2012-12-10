<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * In-theme view.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

?>

<?php neatline_queueNeatlineAssets(); ?>
<?php neatline_queueEditionAssets($exhibit); ?>
<?php neatline_queueInThemeEditionAssets(); ?>

<?php
    $head = array(
      'bodyclass' => 'neatline primary ' . $exhibit->slug,
      'title' => $exhibit->name);
    head($head);
?>

<!-- The core Neatline Edition partial. -->
<?php echo $this->partial('index/_neatlineEdition.php', array(
    'exhibit' => $exhibit,
    'document' => $document
)); ?>

<?php foot(); ?>
