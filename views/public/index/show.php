<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Show edition.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */
?>

<?php queue_css('neatline-editions'); ?>
<?php neatline_queueNeatlineAssets(); ?>
<?php neatline_queueInThemeAssets(); ?>

<!-- Custom page header. -->
<?php echo $this->partial('public/_public_header.php', array(
    'titlePrefix' => 'Neatline',
    'exhibit' => $exhibit
)); ?>

<div class="left">
    <?php echo $document; ?>
</div>

<div class="right">
    <!-- The core Neatline partial. -->
    <?php echo $this->partial('neatline/_neatline.php', array(
        'exhibit' => $exhibit
    )); ?>
</div>
