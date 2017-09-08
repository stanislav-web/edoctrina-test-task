var Quiz = function () {

    var highLightCurrentPage = function () {

        var url = window.location,
            item = jQuery('ul.nav-pills a[href="'+ url.search +'"]'),
            first = jQuery('ul.nav-pills a').first();

            if(item.length) {
                item.addClass('active');
            } else {
                first.addClass('active');
            }

        console.log(url.search, item);
    };

    /**
     * Get public members
     */
    return {
         init : (function() {
             highLightCurrentPage()
         })
    }
};