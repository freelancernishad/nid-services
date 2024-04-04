<template>
    <main>
        <!-- title -->
        <div class="tcheader">
            <h1>Blog post</h1>
        </div>

        <div class="blogpage">
            <div class="reg-blog">


                <div class="reg-blog-post" v-for="(blog,index) in blogs" :key="index">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{ name: 'singleblog', params: { slug: blog.id } }"><i class="fa-solid fa-outdent"></i> {{ blog.category.name }}</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:blog.id}}">{{ blog.title }}</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:blog.id}}">{{ blog.short_description }}</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> {{ blog.created_at }}</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:blog.id}}"><img class="rbimg" :src="$asseturl+blog.fiture" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>

                <Pagination :total-rows="TotalRows" :route-name="RouteName" :route-params="RouteParams" :total-page="Totalpage"></Pagination>
            </div>

            <div class="reg-blog2">
                <hr class="hr2">
                <div class="blog2-title">
                    <p>Discover more of what matters to you</p>
                </div>
                <div class="blog2-category">
                    <a href="#">Prgramming</a>
                    <a href="#">Data science</a>
                    <a href="#">Technology</a>
                    <a href="#">Politics</a>
                    <a href="#">Social</a>
                    <a href="#">Marketing</a>
                    <a href="#">ecommerce</a>
                    <a href="#">Culture</a>
                    <a href="#">Travel</a>
                </div>
                <hr>
                <div class="footer-menu">
                    <a href="TermsAndCondition.html">Terms & Condition</a>
                    <a href="login.html">Login</a>
                </div>

            </div>
        </div>

        <a class="gotop" href="#"><i class="fa-solid fa-file-arrow-up"></i></a>
    </main>

</template>
<script>

export default {

    created() {

    },
    data() {
        return {
            preLooding:false,
            blogs:{},
            PerPageData: '20',
            TotalRows: '1',
            Totalpage: [],
            RouteName:'blog',
            RouteParams:{},
            pageNO: 1,
        };
    },
    watch: {
        '$route':  {
            handler(newValue, oldValue) {

                this.blogsList();


      },
      deep: true



        }
    },
    mounted() {
        this.blogsList();
    },
    methods: {


        async blogsList(){

            this.preLooding = true
            var page = 1;
            if (this.$route.query.page) page = this.$route.query.page;

            var res = await this.callApi('get',`/api/get/blog/list?page=${page}`,[]);
            this.blogs = res.data.data
            this.TotalRows = `${res.data.total}`;
            this.PerPageData = `${res.data.per_page}`;
            this.Totalpage = res.data.links
            if(page==1){
                this.pageNO = 1;
            }else{
                this.pageNO = (page-1)*this.PerPageData+1;
            }


                this.preLooding = false
        },


    },
};
</script>
