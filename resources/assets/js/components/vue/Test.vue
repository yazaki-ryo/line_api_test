<template>
    <button @click="count++">You clicked me {{ count }} times.</button>
</template>

<script>
    export default {
        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
//            console.log('Component mounted.')
        },

        /**
         * The component's data.
         */
        data() {
            return {
                count: 0
            };
        },

        /**
         * The component's methods.
         */
        methods: {
            //
        }
    }
</script>

<style scoped></style>
