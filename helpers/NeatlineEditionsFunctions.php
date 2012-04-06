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
function neatline_queueEditionAssets($exhibit)
{

    // Edition widgets.
    queue_js('neatline_edition', 'javascripts');
    queue_js('neatline_text', 'javascripts');

    // Edition CSS.
    queue_css('neatline-editions');

    // Try to load edition-specific CSS.
    try {
        queue_css($exhibit->slug);
    } catch(Exception $e) {}

    // Google maps API.
    $google = 'http://maps.google.com/maps/api/js?v=3.5&sensor=false';

    // API calls.
    $headScript = __v()->headScript();
    $headScript->appendScript('', 'text/javascript', array('src' => $google));

}

/**
 * Queue loadout for in-theme edition.
 *
 * @return void.
 */
function neatline_queueInThemeEditionAssets()
{
    queue_js('_constructInThemeEdition', 'javascripts');
}

/**
 * Queue loadout for fullscreen edition.
 *
 * @return void.
 */
function neatline_queueFullscreenEditionAssets()
{

    // Application runner.
    queue_js('utilities/_fullscreen_positioner', 'javascripts');
    queue_js('_constructFullscreenEdition', 'javascripts');

    // Fullscreen-specific CSS.
    queue_css('neatline-fullscreen');

}
