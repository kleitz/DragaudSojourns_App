/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Template from './Template.vue';

const regApp = new Vue({
    el: '#app',
    data: {
      // Stored data
    },
    methods: {
      // app-wise functions
    },
    mounted() {
      // do this when ready
    },
    components: {
      // all imported / created compenents
      Template
    },
    computed: {
      // computed data
    }
});
