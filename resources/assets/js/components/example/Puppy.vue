<template>
    <div class="puppy">
        <img :src="puppy.source" :alt="puppy.name">
    </div>
</template>
<script>
    export default {
        data() {
            return {
                puppy: {
                    source: '',
                    name: ''
                },
                //randomPuppy: require('random-puppy')
            }
        },

        mounted() {
//            this.randomPuppy().then(
//                url =>  {
//                    this.puppy.source= url;
//                    this.puppy.name = url;
//                }
//            )
//            //  this.$store.commit();
        },

    };
</script>
<style lang="scss" scoped>
    .puppy  {
        max-width:100%;

        img {
            width: 50%;
            margin:auto;
            display: block;
        }
    }
</style>
