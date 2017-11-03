<template>
    <div class="message" v-bind:class="type" v-show="show">
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
<style lang="scss" scoped>
    .message {
        &.success {
            color: #1afff3;
        }

        &.fail {
            color: magenta;
        }
        &.warning {
            color: orange
        }
    }
</style>
