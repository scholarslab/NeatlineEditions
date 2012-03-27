<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/**
 * Define constants and instantiate the mamanger class.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */


// defines {{{

if (!defined('NLEditons_PLUGIN_VERSION')) {
    define(
        'NLEditions_PLUGIN_VERSION',
        get_plugin_ini('NeatlineEditions', 'version')
    );
}

if (!defined('NLEditions_PLUGIN_DIR')) {
    define(
        'NLEditions_PLUGIN_DIR',
        dirname(__FILE__)
    );
}

// }}}


// requires {{{
require_once NLEditions_PLUGIN_DIR . '/NeatlineEditionsPlugin.php';
require_once NLEditions_PLUGIN_DIR . '/helpers/NeatlineEditionsFunctions.php';
// }}}


/*
 * Run.
 */
new NeatlineEditionsPlugin;
