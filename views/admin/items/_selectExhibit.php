<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * Exhibit selector for item add/edit form.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

?>

<div class="field">
  <label for="exhibit-id">Exhibit</label>
  <div class="inputs">
    <select name="exhibit_id" id="exhibit-id">
      <option>Select Below</option>

      <?php if ($edition): ?>

        <?php foreach ($exhibits as $exhibit): ?>
          <option value="<?php echo $exhibit->id; ?>"
            <?php if ($edition->exhibit_id === $exhibit->id) {
              echo 'selected="selected"';
            } ?>>
            <?php echo $exhibit->name; ?>
          </option>
        <?php endforeach; ?>

      <?php else: ?>

        <?php foreach ($exhibits as $exhibit): ?>
          <option value="<?php echo $exhibit->id; ?>">
            <?php echo $exhibit->name; ?>
          </option>
        <?php endforeach; ?>

      <?php endif; ?>

    </select>
  </div>
</div>
