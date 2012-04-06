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

            // Trackers.
            this.selectedSlug = null;
            this.onSpan = false;

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
                        self.highlightSpans(slug);

                        // Trigger out.
                        self._trigger('spanHover', {}, {
                          'slug': slug
                        });

                        // Set tracker.
                        self.onSpan = true;

                    },

                    // Trigger blug callback.
                    'mouseleave': function() {

                        // Toggle hover class.
                        self.unhighlightSpans(slug);

                        // Trigger out.
                        self._trigger('spanBlur', {}, {
                          'slug': slug
                        });

                        // Set tracker.
                        self.onSpan = false;

                    },

                    // Trigger click callback.
                    'mousedown': function() {

                        // Select the span.
                        self.selectSpans(slug);

                        // Trigger out.
                        self._trigger('spanClick', {}, {
                          'slug': slug
                        });

                    }

                });

            });

            // Listen for mousedown on text region.
            this.element.bind('mousedown', function() {

                // Deselect currently selected spans.
                if (!_.isNull(self.selectedSlug) && !self.onSpan) {
                    self.deselectSpans(self.selectedSlug);
                }

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

            console.log('select');

            // Get spans.
            var spans = this._getSpans(slug);

            // Deselected current selection.
            this.deselectSpans(this.selectedSlug);

            // Change color.
            this._activateSpans(spans);

            // Set trackers.
            spans.data('selected', true);
            this.selectedSlug = slug;

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

            // Abort if not spans.
            if (spans.size() === 0) { return; }

            // Get the new scrollTop.
            var scrollTop = spans.position().top +
                this.element.scrollTop() -
                this.options.css.scroll_top_offset;

            // If the new scroll is greater than the total height,
            // scroll exactly to the bottom.
            var scrollHeight = this.element[0].scrollHeight;
            if (scrollTop > scrollHeight) {
                scrollTop = scrollHeight;
            }

            // Position at the top of the frame.
            this.element.animate({
                'scrollTop': scrollTop + 1
            }, 200);

            // Select the spans.
            this.selectSpans(slug);

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
