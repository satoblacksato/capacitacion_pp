require('./bootstrap');

import Vue from 'vue';

Vue.component('books-category',require('./components/BooksCategory').default);
Vue.component('books-users',require('./components/BooksUsers').default);

const app= new Vue({
   el: '#app'
});

