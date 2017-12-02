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
Vue.component('game-component', require('./components/GameComponent.vue'));
Vue.component('messagebox-component', require('./components/MessageBoxComponent.vue'));
Vue.component('players-component', require('./components/PlayersComponent.vue'));
Vue.component('score-component', require('./components/ScoreComponent.vue'));

Vue.component('questions-component', require('./components/admin/questions-component.vue'));

/**
 * Import directives
 */
import './directives.js'


/**
 * Define the store
 */

// import StoreCommiter from 'laravel-vuex/store-commiter'

let store = require('./store').default;
let channels = ['public']

// Vue.use(StoreCommiter, {channels, store})


const app = new Vue({
    el: '#app',

    store,

    components: {
        'home-view': require('./components/HomeComponent.vue')
    }
});
