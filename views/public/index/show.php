<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * In-theme view.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
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
