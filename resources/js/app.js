require('./bootstrap');

require('alpinejs');

import store from './store';

import Vue from 'vue';

Vue.component('comment-feed', require('./components/CommentFeed.vue').default);

const app = new Vue({
   el: '#app',
   store,
});

axios.interceptors.response.use((response) => {
   return response;
}, function (error) {
   return Promise.reject(error.response);
});