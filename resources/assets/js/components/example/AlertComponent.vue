<template>
    <div class="message" v-bind:class="type" v-show="show">
        <slot></slot>
        <span class="close" @click="show = false">x</span>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                types: {},
                show: true
            }
        },
        mounted() {
          setTimeout(
            () => this.show = false
          , 3000)
        },

        props: ['type'],
        methods: {

        }
    };
</script>
<style lang="scss" scoped>
    .message {
        position: relative;
        color: white;
        font-family:sans-serif;
        padding: 10px;
        &.success {
            background: #1afff3;  }
        &.fail {
            background: #ff32f8;  }
        &.warning {
            background: #ffae12;  }

        .close {
            position: absolute;
            right:5px;
            top:5px;
            font-size: 0.75em;
            color: white;
            opacity:1;
        }
    }
</style>
