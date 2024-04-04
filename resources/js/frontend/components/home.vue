<template>
   <main>
        <!-- banner -->
        <div class="banner1">
            <div class="banner">
                <div class="bsite1">
                    <img class="bimg" :src="$asseturl+'source/banner.png'" alt="">
                </div>
                <div class="bsite2">
                    <p class="bs1">Spark Creativity.</p>
                    <p class="bs2">"Believe in yourself and all that you are. <br>Know that there is something inside you that is greater than any obstacle." <br>- Christian D. Larson</p>
                    <p class="bs3"><a href="#blog1">Start Reading..</a></p>
                </div>
            </div>
        </div>

        <div class="blog1" id="blog1">
            <!-- popular blog -->
            <div>
                    <p class="pb-title"><i class="fa-solid fa-arrow-up-right-dots"></i> Popular Post of Bornomala</p>
            </div>

            <div class="pop-blog">
                    <div class="pop-blog-post">
                        <div class="pbblog1">
                            <div>
                                <p class="number">01</p>
                            </div>
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="pbimg" :src="$asseturl+'source/blog-img.jpg'" alt="blog image"></router-link>
                            </div>
                        </div>
                        <div class="pblog2">
                            <p class="pb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="pb-title2"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="pb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                        </div>
                    </div>
                    <div class="pop-blog-post">
                        <div class="pbblog1">
                            <div>
                                <p class="number">02</p>
                            </div>
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="pbimg" :src="$asseturl+'source/blog-img.jpg'" alt="blog image"></router-link>
                            </div>
                        </div>
                        <div class="pblog2">
                            <p class="pb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="pb-title2"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="pb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                        </div>
                    </div>
                    <div class="pop-blog-post">
                        <div class="pbblog1">
                            <div>
                                <p class="number">03</p>
                            </div>
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="pbimg" :src="$asseturl+'source/blog-img.jpg'" alt="blog image"></router-link>
                            </div>
                        </div>
                        <div class="pblog2">
                            <p class="pb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="pb-title2"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="pb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                        </div>
                    </div>

                    <div class="pop-blog-post">
                        <div class="pbblog1">
                            <div>
                                <p class="number">04</p>
                            </div>
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="pbimg" :src="$asseturl+'source/blog-img.jpg'" alt="blog image"></router-link>
                            </div>
                        </div>
                        <div class="pblog2">
                            <p class="pb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="pb-title2"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="pb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                        </div>
                    </div>
                    <div class="pop-blog-post">
                        <div class="pbblog1">
                            <div>
                                <p class="number">05</p>
                            </div>
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="pbimg" :src="$asseturl+'source/blog-img.jpg'" alt="blog image"></router-link>
                            </div>
                        </div>
                        <div class="pblog2">
                            <p class="pb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="pb-title2"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="pb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                        </div>
                    </div>
                    <div class="pop-blog-post">
                        <div class="pbblog1">
                            <div>
                                <p class="number">06</p>
                            </div>
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="pbimg" :src="$asseturl+'source/blog-img.jpg'" alt="blog image"></router-link>
                            </div>
                        </div>
                        <div class="pblog2">
                            <p class="pb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="pb-title2"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="pb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                        </div>
                    </div>
            </div>
        </div>
        <hr class="hr1">

        <!-- regular blog -->
        <div class="blog2">
            <div class="reg-blog">



                <div class="reg-blog-post" v-for="(blog,index) in blogs" :key="index">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:blog.id}}"><i class="fa-solid fa-outdent"></i> {{ blog.category.name }}</router-link></p>
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
<style  scoped>
.position-absolute.loginContainer {
    width: 100%;
    text-align: center;
}


</style>
