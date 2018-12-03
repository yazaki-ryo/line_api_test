
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./common');
require('./components/tooltip');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('v-preview', require('./components/vue/Preview.vue'));
Vue.component('v-test', require('./components/vue/Test.vue'));

const app = new Vue({
    el: '#app',
    data: {
        src: ''
      },
      methods: {
          handleChange: function (event) {
              var file = event.target.files[0]
              if (file && file.type.match(/^image\/(png|jpeg)$/)) {
                  this.src = window.URL.createObjectURL(file)
              }
          }
      }
});
