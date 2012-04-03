/**
 * Application runner for in-theme edition.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */

jQuery(document).ready(function($) {


    // Get markup.
    var editionContainer = $('.neatline-edition-container');


    /*
     * =================
     * Positioner.
     * =================
     */

    editionContainer.fullscreenpositioner({
        'resize': function() {
            editionContainer.neatlineEdition('positionViewports');
        }
    });


    /*
     * =================
     * Edition.
     * =================
     */


    editionContainer.neatlineEdition();

});
