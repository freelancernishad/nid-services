<template>
    <div>

            <slot></slot>


    </div>
</template>
<script>
export default {
    props: ['user', 'latestpost'],
    async created() {

        // console.log(this.latestpost)
        this.$store.commit('setlatestpost', this.latestpost)

        this.getMainMenu();

    },

    data() {
        return {
            menus: {},
        }
    },
    methods: {
        async getMainMenu() {
            var res = await this.callApi('get', `/api/get/all/category`, []);
            this.menus = res.data
        },
    },
    mounted() {

    }
}
</script>
<style>
span.Headtitle {
    position: absolute;
    background: #001080;
    color: white;
    z-index: 99;
    padding: 2px 13px 2px 26px;
}

a.nav-link.router-link-exact-active.router-link-active {
    background: var(--brand-hover-color);
    border-bottom: 2px solid var(--brand-object-color);
}

.scroll-parent {
    position: relative;
}

.scroll .title {
    color: #fff;
    background: #b50301;
    float: left;
    font-size: 17px;
    height: 36px;
    line-height: 34px;
    margin: 0;
    padding-left: 8px;
    padding-right: 8px;
    position: absolute;
    z-index: 99;
    border-right: 10px solid #152437;
}

.scroll a {
    color: #fff;
    font-size: 17px;
    text-decoration: none;
    margin: 5px 0 5px 7px;
    display: inline-block;
}

.scroll a:hover {
    color: #F00;
}

.header_top_section {
    padding: 5px 0px;
    background: #FFF;
    box-shadow: 0px 5px 5px -5px #000;
}

.searchform input[type="text"] {
    border-radius: 4px 0px 0px 4px;
    height: 28px;
    background: #FFF;
    color: #363131;
    border-radius: 0;
    border: none;
}

button,
input,
select,
textarea {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
}

.search_submit_button {
    background-color: #000;
    color: #FFF;
    border-radius: 0px 4px 5px 0px;
    border: none;
    height: 26px;
    padding: 0px;
    background-color: #9c9c9c;
    margin-top: 1px;
}

.header_top_section .social-media {
    margin-bottom: 0px;
    text-align: right;
}

.social-media li {
    display: inline-block;
}

.social-media li a,
.social-media li button {
    color: #000;
    border: none;
    background: none;
    padding: 0;
}

.header_top_section .social-media li a i,
.header_top_section .social-media li button i {
    width: 20px;
    height: 20px;
    border-radius: 0;
    line-height: 20px;
    font-size: 12px;
}

.social-media li a i,
.social-media li button i {
    width: 34px;
    height: 34px;
    border-radius: 100%;
    text-align: center;
    line-height: 34px;
    color: #fff;
}

.copyright .copy {
    font-size: 12px;
}.copyright .padding {
    padding: 10px;
    float: left;
}
.copyright .right .padding div:first-child {
    width: 50%;
    float: left;
    line-height: 1.7em;
    padding-left: 18px;
    border-left: 1px solid red;
}
.copyright .right .padding div:first-child {
    width: 50%;
    float: left;
    line-height: 1.7em;
}
.copyright .right .padding div:nth-child(2) {
    width: 40%;
    float: right;
    padding-left: 5%;
    border-left: 1px solid red;
    font-size: 17px;
    line-height: 1.8em;
}
.copyright .right .padding div:nth-child(2) {
    width: 40%;
    float: right;
    padding-left: 5%;
    border-left: 1px solid black;
    font-size: 17px;
    line-height: 1.8em;
}.width33 {
    width: 33%;
    float: left;
}
.width66 {
    width: 66%;
    float: left;
}
.jFooterBottom {
    width: 100%;
    background: #2f343f;
}
.jFooterBottom ul {
    list-style: none;
    margin: 0;
    padding: 0;
}.jFooterBottom ul li {
    display: inline-block;
}.jFooterBottom ul li a {
    color: #fff;
    margin: 10px 5px;
    display: block;
}
</style>
