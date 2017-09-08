var Quiz = (function () {

    /**
     * Highlight current page
     */
    var highLightCurrentPage = function () {

        var url = window.location,
            item = jQuery('ul.nav-pills a[href="' + url.search + '"]'),
            first = jQuery('ul.nav-pills a').first();

        if (item.length) {
            item.addClass('active');
        } else {
            first.addClass('active');
        }
    };

    /**
     * Get public members
     */
    return {
        init: (function () {
            highLightCurrentPage()
        })
    }
})(jQuery);