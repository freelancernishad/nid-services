<template>
    <div>





        <slot></slot>



    </div>
</template>
<script>
export default {
     props: ['user'],
    created() {



        // console.log(this.user)


    },

    data() {
        return {

        }
    },
    methods: {

    },
    mounted() {

    }
}
</script>
