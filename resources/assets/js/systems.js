
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

/**
 * Tooltips
 */
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
