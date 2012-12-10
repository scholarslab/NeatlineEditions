<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * Plugin runner.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

require_once dirname(__FILE__) . '/NeatlineEditionsPlugin.php';
require_once dirname(__FILE__) . '/helpers/NeatlineEditionsFunctions.php';
new NeatlineEditionsPlugin;
