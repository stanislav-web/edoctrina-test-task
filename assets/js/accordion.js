jQuery(function () {

    var active = true;

    jQuery('#collapse-init').click(function () {
        if (active) {
            active = false;
            jQuery('.collapse').collapse('show');
            jQuery('.collapsed').attr('data-toggle', '');
            jQuery(this).text('Expand all');
        } else {
            active = true;
            jQuery('.collapse').collapse('hide');
            jQuery('.collapsed').attr('data-toggle', 'collapse');
            jQuery(this).text('Collapse all');
        }
    });

    jQuery('#accordion').on('show.bs.collapse', function () {
        if (active) jQuery('#accordion .in').collapse('hide');
    });

});