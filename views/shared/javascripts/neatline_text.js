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
                span: 'span.neatline-span',
            },

            // CSS constants.
            css: {
                scroll_top_offset: 100
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

                var span = $(span);
                var slug = span.attr('slug');

                span.bind({

                    // Trigger hover callback.
                    'mouseenter': function() {

                        // Toggle hover class.
                        self.highlightSpans(span);

                        // Trigger out.
                        self._trigger('spanHover', {}, {
                          'slug': slug
                        });

                    },

                    // Trigger blug callback.
                    'mouseleave': function() {

                        // Toggle hover class.
                        self.unhighlightSpans(span);

                        // Trigger out.
                        self._trigger('spanBlur', {}, {
                          'slug': slug
                        });

                    },

                    // Trigger click callback.
                    'mousedown': function() {

                        // Trigger out.
                        self._trigger('spanClick', {}, {
                          'slug': slug
                        });

                    }

                });

            });

        },


        /*
         * ====================
         * DOM touches.
         * ====================
         */


        /*
         * Highlight spans by slug.
         *
         * @param string slug: The slug.
         *
         * @return void.
         */
        highlightSpans: function(slug) {

            // Get spans.
            var spans = this._getSpans(slug);

            // Trigger hover.
            this._activateSpans(spans);

        },

        /*
         * Unhighlight spans by slug.
         *
         * @param string slug: The slug.
         *
         * @return void.
         */
        unhighlightSpans: function(slug) {

            // Get spans.
            var spans = this._getSpans(slug);

            // Block if selected.
            if (!spans.data('selected')) {
                this._deactivateSpans(spans);
            }

        },

        /*
         * Select spans by slug.
         *
         * @param string slug: The slug.
         *
         * @return void.
         */
        selectSpans: function(slug) {

            // Get spans.
            var spans = this._getSpans(slug);

            // Trigger hover.
            this._activateSpans(spans);

            // Set data attribute.
            spans.data('selected', true);

        },

        /*
         * Select spans by slug.
         *
         * @param string slug: The slug.
         *
         * @return void.
         */
        deselectSpans: function(slug) {

            // Get spans.
            var spans = this._getSpans(slug);

            // Trigger hover.
            this._deactivateSpans(spans);

            // Set data attribute.
            spans.data('selected', false);

        },

        /*
         * Scroll to a span.
         *
         * @param string slug: The slug.
         *
         * @return void.
         */
        scrollToSpans: function(slug) {

            // Get spans.
            var spans = this._getSpans(slug);

            // Get the new scrollTop.
            var scrollTop = spans.position().top +
                this.element.scrollTop() - this.options.css.scroll_top_offset;

            // If the new scroll is greater than the total height,
            // scroll exactly to the bottom.
            if (scrollTop > this.element[0].scrollHeight) {
                scrollTop = this.element[0].scrollHeight;
            }

            // Position at the top of the frame.
            this.element.animate({
                'scrollTop': scrollTop + 1
            }, 200);

        },

        /*
         * Activate a span.
         *
         * @param DOM Element span: The span.
         *
         * @return void.
         */
        _activateSpans: function(spans) {
            spans.addClass('active');
        },

        /*
         * Deactivate a span.
         *
         * @param DOM Element span: The span.
         *
         * @return void.
         */
        _deactivateSpans: function(spans) {
            spans.removeClass('active');
        },

        /*
         * Get all spans with a slug.
         *
         * @param string slug: The slug.
         *
         * @return DOM array: The spans.
         */
        _getSpans: function(slug) {
            return this.element.find(
              this.options.markup.span + '[slug="' + slug + '"]'
            );
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
