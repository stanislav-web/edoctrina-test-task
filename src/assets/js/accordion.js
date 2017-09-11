jQuery(function () {

    var active = true;
    console.log(active);
    jQuery('#collapse-init').click(function () {
        if (active) {
            active = false;
            jQuery('.collapse').collapse('show');
            jQuery('.collapsed').attr('data-toggle', '');
            jQuery(this).text('Collapse all');
        } else {
            active = true;
            jQuery('.collapse').collapse('hide');
            jQuery('.collapsed').attr('data-toggle', 'collapse');
            jQuery(this).text('Expand all');
        }
    });

    jQuery('#accordion').on('show.bs.collapse', function () {
        if (active) jQuery('#accordion').find('.in').collapse('hide');
    });

});