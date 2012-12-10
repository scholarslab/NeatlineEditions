<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * Fullscreen view.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

?>

<?php neatline_queueNeatlineAssets(); ?>
<?php neatline_queueEditionAssets($exhibit); ?>
<?php neatline_queueFullscreenEditionAssets(); ?>


<!-- Custom page header. -->
<?php echo $this->partial('public/_public_header.php', array(
    'titlePrefix' => 'Neatline',
    'exhibit' => $exhibit
)); ?>

<!-- The top bar. -->
<?php echo $this->partial('public/_topbar.php', array(
    'neatline' => $exhibit,
    'layers' => $layers
)); ?>

<!-- The core Neatline Edition partial. -->
<?php echo $this->partial('index/_neatlineEdition.php', array(
    'exhibit' => $exhibit,
    'document' => $document
)); ?>

<!-- Custom footer. -->
<?php echo $this->partial('editor/_editor_footer.php'); ?>
