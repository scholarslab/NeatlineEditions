/**
 * Neatline edition manager widget.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2012 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */

(function($, undefined) {

  'use strict';

    $.widget('neatline.neatlineEdition', {

        options: {

            // Markup hooks.
            markup: {
                exhibit:        '.neatline-container',
                text:           '.neatline-text-container'
            },

        },

        /*
         * Get markup, instantiate the viewports.
         *
         * @return void.
         */
        _create: function() {

            // Getters.
            this._window =      $(window);
            this._body =        $('body');
            this.exhibit =      $(this.options.markup.exhibit);
            this.text =         $(this.options.markup.text);

            // Construct widgets.
            this._instantiateWidgets();

            // Position viewports.
            this.positionViewports();

        },

        /*
         * Measure container, position viewports.
         *
         * @return void.
         */
        positionViewports: function() {

            // Measure container.
            this.height = this.element.height();
            this.width = this.element.outerWidth(true);

            // Measure text.
            this.textWidth = this.text.outerWidth(true);

            // Apply height.
            this.exhibit.height(this.height);
            this.text.height(this.height);

            // Apply width to exhibit.
            this.exhibit.width(this.width - this.textWidth);

            // Redraw the exhibit.
            this.exhibit.neatline('positionDivs');

        },

        /*
         * Construct text and exhibit, wire up crosswalks.
         *
         * @return void.
         */
        _instantiateWidgets: function() {

            var self = this;

            // Construct exhibit.
            this.exhibit.neatline({

                // When the user clicks on an item on the timeline.
                'timelineeventclick': function(event, obj) {

                    // Focus the map.
                    self.exhibit.neatline(
                        'zoomMapToItemVectors',
                        obj.recordid
                    );

                    // Focus the items tray.
                    self.exhibit.neatline(
                        'showItemDescription',
                        obj.recordid
                    );

                },

                // When the user clicks on a feature on the map.
                'mapfeatureclick': function(event, obj) {

                    // Focus the timeline.
                    self.exhibit.neatline(
                        'zoomTimelineToEvent',
                        obj.recordid
                    );

                    // Focus the items tray.
                    self.exhibit.neatline(
                        'showItemDescription',
                        obj.recordid
                    );

                },

                // When the user clicks on an item in the items tray.
                'itemclick': function(event, obj) {

                    // Focus the map.
                    self.exhibit.neatline(
                        'zoomMapToItemVectors',
                        obj.recordid
                    );

                    // Focus the timeline.
                    self.exhibit.neatline(
                        'zoomTimelineToEvent',
                        obj.recordid
                    );

                    // Focus the items tray.
                    self.exhibit.neatline(
                        'showItemDescription',
                        obj.recordid
                    );

                }

            });

            // Construct text.
            this.text.neatlineText({

                'spanClick': function(event, obj) {

                    // Focus the map.
                    self.exhibit.neatline(
                        'zoomMapToItemVectorsBySlug',
                        obj.slug
                    );

                    // Focus the timeline.
                    self.exhibit.neatline(
                        'zoomTimelineToEventBySlug',
                        obj.slug
                    );

                    // Focus the items tray.
                    self.exhibit.neatline(
                        'showItemDescriptionBySlug',
                        obj.slug
                    );

                },

                'spanHover': function(event, obj) {
                    console.log(obj.slug);
                }

            });

        },


        /*
         * ====================
         * DOM touches.
         * ====================
         */


        /*
         * Highlight a span.
         *
         * @param string slug: The slug.
         *
         * @return void.
         */
        highlightSpan: function(slug) {

        },

        /*
         * Unhighlight a span.
         *
         * @param string slug: The slug.
         *
         * @return void.
         */
        unhighlightSpan: function(slug) {

        },

        /*
         * Scroll to a span.
         *
         * @param string slug: The slug.
         *
         * @return void.
         */
        scrollToSpan: function(slug) {

        },


        /*
         * ====================
         * Getters and setters.
         * ====================
         */


        /*
         * Emit a protected class attribute.
         *
         * @param string attr: The name of the attribute.
         *
         * @return mixed attr: The value of the attribute.
         */
        getAttr: function(attr) {
            return this[attr];
        },

        /*
         * Set a class attribute.
         *
         * @param string attr: The name of the attribute.
         *
         * @return void.
         */
        setAttr: function(attr, value) {
            return this[attr] = value;
        }

    });


})(jQuery);
