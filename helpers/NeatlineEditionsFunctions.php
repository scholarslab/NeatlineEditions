<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Helper functions.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */

/**
 * Include the static files for an edition.
 *
 * @return void.
 */
function neatline_queueEditionAssets()
{

    // Edition manager.
    queue_js('neatline_edition', 'javascripts');

    // Application runner.
    queue_js('_constructNeatlineEdition', 'javascripts');

    // Public-specific CSS additions.
    queue_css('neatline-public');

    $google = 'http://maps.google.com/maps/api/js?v=3.5&sensor=false';

    // API calls.
    $headScript = __v()->headScript();
    $headScript->appendScript('', 'text/javascript', array('src' => $google));

}
