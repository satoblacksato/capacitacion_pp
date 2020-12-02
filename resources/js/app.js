require('./bootstrap');

import Vue from 'vue';

Vue.component('books-category',require('./components/BooksCategory').default);

const app= new Vue({
   el: '#app'
});

