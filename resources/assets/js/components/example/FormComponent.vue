<template>
   <div>
       <form method="POST" action="/post/1">
           <button type="submit">delete Post</button>
       </form>
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

        props: [''],
        methods: {

        }
    };
</script>
<style lang="scss" scoped>

</style>
