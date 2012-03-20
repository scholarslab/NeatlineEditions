<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Exhibit selector for item add/edit form.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */
?>

<div class="field">
  <label for="exhibit-id">Exhibit</label>
  <div class="inputs">
    <select name="exhibit_id" id="exhibit-id">
      <option>Select Below</option>
      <?php foreach ($exhibits as $exhibit): ?>
        <option value="<?php echo $exhibit->id; ?>">
          <?php echo $exhibit->name; ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
</div>
