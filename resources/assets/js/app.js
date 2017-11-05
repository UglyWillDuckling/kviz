
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

Vue.directive('ajax', {
    bind: function (el, binding, vnode) {
        //alert('bound');
        el.addEventListener('submit', binding.def.onFormSubmition.bind(binding));
    },

    unbind: function (me) {
        alert('unbound')
    },
    update: function (value) {
        alert('update')
    },

    onFormSubmition: function (e) {
        e.preventDefault();
        axios[this.def.getRequestType(e.currentTarget)](
            e.currentTarget.action
        )
            .then(this.def.onComplete.bind(this))
            .catch(error => {
                alert('an error occurred.');
            });;
    },

    getRequestType: function (el) {
        var method = el.querySelector('input[name=_method]');
        return method ? method.value.toLowerCase() : el.method.toLowerCase();
    },
    onComplete: function (data) {
        alert('submitted the form!');
    }
});

const app = new Vue({
    el: '#app'
});
