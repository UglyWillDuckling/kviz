import Vue from 'vue'

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
            });
        ;
    },

    getRequestType: function (el) {
        var method = el.querySelector('input[name=_method]');
        return method ? method.value.toLowerCase() : el.method.toLowerCase();
    },
    onComplete: function (data) {
        alert('submitted the form!');
    }
});