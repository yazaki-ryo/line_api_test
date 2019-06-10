
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./common');
require('./components/tooltip');
require('./components/customer');
require('./components/reservation');
require('babel-polyfill');

window.Vue = require('vue');
window.Vue.use(require('vuetify'));
Vue.component('n-customer-chooser', require('./components/vue/CustomerChooser.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));

app = new Vue({
    el: '#app',
    data: {
      callback: {}
    },
    methods: {
      registerCallback(name, func) {
        this.$set(this.callback, name, func);
      }
    }
});
appvm = app;