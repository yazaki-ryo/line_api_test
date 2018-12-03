$(function () {
    /**
     * Supported options are [container, delay, html, placement, selector, template, title, trigger, offset, fallbackPlacement, boundary]
     *
     * @see https://getbootstrap.com/docs/4.1/components/tooltips/#options
     */
    $('[data-toggle="tooltip"]').tooltip({
        container: "body",
        delay: { "show": 300, "hide": 100 },
        html: true
    });
});

$(function () {
    $('[data-toggle="popover"]').popover({
            container: "body",
            placement: "top",
            trigger: "hover",
        delay: { "show": 300, "hide": 100 },
        html: true
    });
});
