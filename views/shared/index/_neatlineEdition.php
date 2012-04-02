<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Edition partial.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */
?>

<div class="neatline-edition-container">

  <div class="left">
      <div class="neatline-text-container">
          <?php echo $document; ?>
      </div>
  </div>

  <div class="right">
      <!-- The core Neatline partial. -->
      <?php echo $this->partial('neatline/_neatline.php', array(
          'exhibit' => $exhibit
      )); ?>
  </div>

</div>

<!-- Instantiate. -->
<script>
  jQuery(document).ready(function($) {
    $('.neatline-edition-container').neatlineEdition();
  });
</script>
