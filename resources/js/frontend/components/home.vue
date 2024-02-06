<template>
    <div class="position-relative">

        <div class="logo text-center"><img  width="200px" :src="$asseturl+'logo.jpg'" alt=""></div>
        <div class="position-absolute loginContainer">
            <div class="login"><router-link to="/login"><img :src="$asseturl+'login.jpg'" alt=""></router-link></div>
        </div>




    </div>
</template>
<script>

export default {

    created() {

    },
    data() {
        return {

        };
    },
    mounted() {
    },
    methods: {

    },
};
</script>
<style  scoped>
.position-absolute.loginContainer {
    width: 100%;
    text-align: center;
}


</style>
