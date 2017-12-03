<template>
    <select :name="name" @change="filterChanged">
        <option selected value> -- select an option -- </option>
        <option value="1">yes</option>
        <option value="1">no</option>
    </select>
</template>
<script>
    export default {
        data() {
            return {}
        },

        props: ['name', 'options'],

        mounted() {
        },

        methods: {
            filterChanged(e) {
                this.$emit('filter_chanaged', this.name, e.currentTarget.value)
            }
        }
    };
</script>
<style lang="scss" scoped>
</style>
