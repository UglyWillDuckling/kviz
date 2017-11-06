<template>
    <div>
        <transition
                name="fade"
                mode="out-in"
                enter-active-class="animated flipInX"
                leave-active-class="animated flipOutY"
        >
            <p v-if="show">
                Hello stranger.
            </p>
        </transition>
        <button @click="show = !show">click</button>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                show: true
            }
        },

        methods: {
            beforeEnter: function (el) {
                el.className = '';
            },
            afterEnter: function (el) {
                console.log(el)
            }
        }
    };
</script>
<style lang="scss" scoped>
    div {
        background: grey;
        height: 50px;
    }

</style>
