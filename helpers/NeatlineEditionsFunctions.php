<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * Helper functions.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */


/**
 * Include the static files for an edition.
 */
function neatline_queueEditionAssets($exhibit)
{

    // Edition widgets.
    queue_js('neatline_edition', 'javascripts');
    queue_js('neatline_text', 'javascripts');
    queue_js('lib/setOuter', 'javascripts');

    // Edition CSS.
    queue_css('neatline-editions');

    // Try to load edition-specific CSS.
    try {
        queue_css($exhibit->slug);
    } catch(Exception $e) {}

    // Google maps API.
    $google = 'http://maps.google.com/maps/api/js?v=3.8&sensor=false';

    // Google maps.
    $headScript = __v()->headScript();
    $headScript->appendScript('', 'text/javascript',
        array('src' => $google));

}


/**
 * Queue loadout for in-theme edition.
 */
function neatline_queueInThemeEditionAssets()
{
    queue_js('_constructInThemeEdition', 'javascripts');
}


/**
 * Queue loadout for fullscreen edition.
 */
function neatline_queueFullscreenEditionAssets()
{

    // Application runner.
    queue_js('utilities/_fullscreen_positioner', 'javascripts');
    queue_js('_constructFullscreenEdition', 'javascripts');

    // Fullscreen-specific CSS.
    queue_css('neatline-fullscreen');

}
