
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

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });

// apollo for graphql
import VueApollo from 'vue-apollo'
Vue.use(VueApollo)

// import vue router
import VueRouter from 'vue-router';
Vue.use(VueRouter);
const apolloProvider = new VueApollo({
    defaultClient: apolloClient,
})

// import routes list
import routes from './routes.js';
const router = new VueRouter({ mode: 'history', routes: routes});

new Vue(Vue.util.extend({ router,apolloProvider })).$mount('#app');