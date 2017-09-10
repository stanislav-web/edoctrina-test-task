/**
 * Form class
 *
 * @type {{radio}}
 */
var Form = (function () {

    /**
     * Max limit of fields
     * @type {number}
     */
    var fieldMax = 5;

    /**
     * Init min number of fields
     * @type {number}
     */
    var filedMin = 2;

    /**
     * Init number of fields
     * @type {number}
     */
    var filedCounter = 2;

    /**
     * Show message ballon
     *
     * @param message
     */
    var showModalMessage = function (message) {
        var modalMessage = jQuery('#modal-message');
        modalMessage.html(message).show();
        window.setTimeout(function () {
            modalMessage.hide();
        }, 3000);
    };

    /**
     * Radio switcher
     *
     * @param event
     * @param obj
     */
    var radioSwitch = function (event, obj) {

        event.preventDefault();
        var index = jQuery(obj).attr('data-title');
        var toggle = jQuery(obj).attr('data-toggle');

        jQuery('#' + toggle).prop('value', index);
        jQuery('a[data-toggle="' + toggle + '"]').not('[data-title="' + index + '"]').removeClass('active').addClass('notActive');
        jQuery('a[data-toggle="' + toggle + '"][data-title="' + index + '"]').removeClass('notActive').addClass('active');
    };

    /**
     * Re calculate index of radio btn
     */
    var reCount = function () {
        jQuery('a.btn').each(function (i) {
            jQuery(this).attr('data-title', i);
        })
    };

    /**
     * Add / Remove fileds
     */
    jQuery(document)
        .on('click', '.btn-add', function (e) {
            e.preventDefault();

            if (filedCounter >= fieldMax) {
                showModalMessage('You can add only ' + fieldMax + ' fields');
                return false;
            }

            var controlFormFieldArea = jQuery('.controls .form-field:first'),
                currentEntry = jQuery(this).parents('.entry:first'),
                newEntry = jQuery(currentEntry.clone()).appendTo(controlFormFieldArea);

            newEntry.find('input').val('');
            controlFormFieldArea.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-primary').addClass('btn-danger')
                .html('<span class="fa fa-minus-square"></span>');

            // update radio
            newEntry.find('a.btn').removeClass('active').addClass('notActive');
            reCount();
            filedCounter++;
        })
        .on('click', '.btn-remove', function (e) {

            e.preventDefault();

            if (filedCounter === filedMin) {
                showModalMessage('You can not remove last ' + filedMin + ' fields');
                return false;
            }

            jQuery(this).parents('.entry:first').remove();
            reCount();

            if (0 === jQuery('a.btn.active').length) {
                radioSwitch(event, jQuery('a.btn:first')); // switch to first
            }

            filedCounter--;

        });

    return {
        radio: radioSwitch
    }

})(jQuery);