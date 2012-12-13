<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * Edition partial.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

?>

<div class="neatline-edition-container">

  <div class="neatline-text-container"><?php echo $document; ?></div>

  <!-- The core Neatline partial. -->
  <?php echo $this->partial('neatline/_neatline.php', array(
      'exhibit' => $exhibit
  )); ?>

</div>

<!-- Instantiate. -->
<script>
  jQuery(document).ready(function($) {
    $('.neatline-edition-container').neatlineEdition();
  });
</script>
