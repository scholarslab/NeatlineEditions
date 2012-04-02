/**
 * Neatline text widget.
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

    $.widget('neatline.neatlineText', {

        options: {

            // Markup hooks.
            markup: {
                span: 'span.neatline-span'
            }

        },

        /*
         * Get markup and bind events.
         *
         * @return void.
         */
        _create: function() {

            // Bind events to markup hooks.
            this._addEvents();

        },

        /*
         * Bind listeners to markup hooks on document.
         *
         * @return void.
         */
        _addEvents: function() {

            var self = this;

            // Get spans.
            var spans = this.element.find(this.options.markup.span);

            _.each(spans, function(span) {

                var slug = $(span).attr('slug');

                $(span).bind({

                    // Trigger hover callback.
                    'mouseenter': function() {
                        self._trigger('spanHover', {}, {
                          'slug': slug
                        });
                    },

                    // Trigger click callback.
                    'mousedown': function() {
                        self._trigger('spanClick', {}, {
                          'slug': slug
                        });
                    }

                });

            });

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
