//TODO: refactoring
(function($){

var origOuterWidth = $.fn.outerWidth,
    origOuterHeight = $.fn.outerHeight;

/**
 * Get the current outer width for the first element in the set of matched elements.
 * or set the outer width of each element in the set of matched elements.
 * 
 * @param {number} [value] An integer representing the number of pixels. NOTE: value is not permitted within optional unit.
 * @param {boolean} [includeMargin]
 */
$.fn.outerWidth = function(){
    var value = arguments[0];

    if(arguments.length === 0 || typeof value === 'boolean'){
        return origOuterWidth.apply(this, arguments);
    }
    else if(typeof value !== 'number') {
        throw new Error('Invalid argument. The new outerWidth value must be an integer.');
    }

    var css = [
        'borderLeftWidth',
        'borderRightWidth',
        'paddingLeft',
        'paddingRight'
    ];
    if(arguments[1] === true){
        css.push('marginLeft');
        css.push('marginRight');
    }

    var $el = $(this),
        exclude = 0,
        parse = parseFloat;
    for(var i=0; i<css.length; i++){
        exclude += parse($el.css(css[i]));
    }

    return $el.width(value - exclude);
};

/**
 * Get the current outer height for the first element in the set of matched elements.
 * or set the outer height of each element in the set of matched elements.
 * 
 * @param {number} [value] An integer representing the number of pixels. NOTE: value is not permitted within optional unit.
 * @param {boolean} [includeMargin]
 */
$.fn.outerHeight = function(){
    var value = arguments[0];

    if(arguments.length === 0 || typeof value === 'boolean'){
        return origOuterHeight.apply(this, arguments);
    }
    else if(typeof value !== 'number') {
        throw new Error('Invalid argument. The new outerHeight value must be an integer.');
    }

    var css = [
        'borderTopWidth',
        'borderBottomWidth',
        'paddingTop',
        'paddingBottom'
    ];
    if(arguments[1] === true){
        css.push('marginTop');
        css.push('marginBottom');
    }

    var $el = $(this),
        exclude = 0,
        parse = parseFloat;
    for(var i=0; i<css.length; i++){
        exclude += parse($el.css(css[i]));
    }

    return $el.height(value - exclude);
};

})(jQuery);
