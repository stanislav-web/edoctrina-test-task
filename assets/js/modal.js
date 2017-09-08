var Modal = (function () {

    /**
     * Set modal title
     *
     * @param modal
     * @param title
     */
    var setModalTitle = function (modal, title) {
        var modal = jQuery(modal).find('.modal-header');
        modal.html(title);
    };

    /**
     * Set modal body
     *
     * @param modal
     * @param body
     */
    var setModalBody = function (modal, body) {
        var modal = jQuery(modal).find('.modal-body');
        modal.html(body);
    };

    /**
     * Confirm dialog
     */
    var confirm = function (e) {
        jQuery('#confirm-delete').on('show.bs.modal', function (e) {
            setModalTitle(e.delegateTarget, jQuery(e.relatedTarget).data('title'));
            setModalBody(e.delegateTarget, jQuery(e.relatedTarget).data('description'));
            jQuery(this).find('.btn-ok')
                .attr('href', jQuery(e.relatedTarget).data('href'));
        });
    };

    /**
     * Get public members
     */
    return {
        confirmDialog: confirm
    }
})();