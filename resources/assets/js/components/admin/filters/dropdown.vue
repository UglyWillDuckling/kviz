<template>
    <select :name="name" @change="filterChanged">
        <option selected value> -- select an option -- </option>

        <option v-for="option in options" :value="option.value">
            {{ option.label }}
        </option>
    </select>
</template>
<script>
    export default {
        data() {
            return {}
        },

        props: ['options', 'name'],

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
