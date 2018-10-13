
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

import { Form, HasError, AlertError } from 'vform'

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import VueRouter from 'vue-router';
Vue.use(VueRouter);

let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue') },
    { path: '/profile',  component: require('./components/Profile.vue') },
    { path: '/users',  component: require('./components/Users.vue') },
    { path: '/professors',  component: require('./components/Professors.vue') },
    { path: '/students',  component: require('./components/Students.vue') },
];

const router = new VueRouter({
    routes
})

Vue.filter('capitalize', function(text) {
    return text[0].toUpperCase() + text.slice(1);
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
