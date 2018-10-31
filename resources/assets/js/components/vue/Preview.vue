<template>
    <div v-if="src"><img v-bind:src="src"></div>
</template>

<script>
    export default {
    	   /**
        * Prepare the component (Vue 1.x).
        */
        ready() {
//            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
//            this.prepareComponent();
            console.log('Component mounted.')
        },

        /**
         * The component's data.
         */
        data() {
            return {
            	    src: ''
            };
        },

        /**
         * The component's methods.
         */
        methods: {
        	    handleChange(event) {
                var file = event.target.files[0]
                if (file && file.type.match(/^image\/(png|jpeg)$/)) {
                    this.src = window.URL.createObjectURL(file)
                }
            }
        }
    }
</script>

<style scoped></style>
