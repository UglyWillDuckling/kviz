<template>
    <div v-bind:class="type" v-show="show">
        <slot></slot>
        <span @click="show = false">x</span>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                types: {},
                show: true
            }
        },

        props: ['type'],
        methods: {

        }
    };
</script>
<style>
    .success {
        color: blue;
    }

    .fail {
        color: magenta;
    }
    .warning {
        color: orange
    }
</style>
