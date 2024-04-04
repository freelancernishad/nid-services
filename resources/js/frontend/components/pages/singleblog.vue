<template>
    <main>

            <div class="article-head">
                <h1>{{ form.title }}</h1>
                <div class="post-info">
                    <div class="post-img">
                        <img src="source/photo.webp" alt="writer">
                    </div>
                    <div class="post-writer">
                        <p><span><a href="#">Alexa linkin </a></span> <span><a href="#"> . Follow</a></span></p>
                        <p>Published in <span><a href="#">Developoment</a></span> <span> . Mar 12 2024</span></p>
                    </div>
                </div>
                <div>
                    <hr>
                    <div class="post-support">
                        <p><i class="fa-solid fa-hands-clapping"></i> <span>45</span></p>
                        <p><i class="fa-solid fa-comments"></i> <span>10</span></p>
                    </div>
                    <hr>
                </div>

                <!-- article -->

                <div class="article">

                    <img :src="form.fiture" alt="">
                    <div v-html="form.long_description"></div>
                </div>
            </div>

            <div class="recom-post">
                <h1>Recommended from Bornomala</h1>
                <hr>
                <div class="recom-post-list">
                    <div class="recommended">
                        <div class="recom-p">
                            <img src="source/post1 image.jpg" alt="">
                            <div class="repost-info">
                                <div class="repost-img">
                                    <img src="source/photo.webp" alt="writer">
                                </div>
                                <div class="repost-writer">
                                    <p><span><a href="#">Alexa linkin </a></span> <span><a href="#"> . Follow</a></span></p>
                                    <p>Published in <span><a href="#">Developoment</a></span> <span> . Mar 12 2024</span></p>
                                </div>
                            </div>
                            <div class="recom-p-title">
                                <p><a href="singleblog.html">Stop Listening to Music, It Will Change Your Life</a></p>
                            </div>
                            <div class="recom-p-details">
                                <p><a href="singleblog.html">I stopped listening to music, find out what the results and benefits are in this post!</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="recommended">
                        <div class="recom-p">
                            <img src="source/post1 image.jpg" alt="">
                            <div class="repost-info">
                                <div class="repost-img">
                                    <img src="source/photo.webp" alt="writer">
                                </div>
                                <div class="repost-writer">
                                    <p><span><a href="#">Alexa linkin </a></span> <span><a href="#"> . Follow</a></span></p>
                                    <p>Published in <span><a href="#">Developoment</a></span> <span> . Mar 12 2024</span></p>
                                </div>
                            </div>
                            <div class="recom-p-title">
                                <p><a href="singleblog.html">Stop Listening to Music, It Will Change Your Life</a></p>
                            </div>
                            <div class="recom-p-details">
                                <p><a href="singleblog.html">I stopped listening to music, find out what the results and benefits are in this post!</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="recommended">
                        <div class="recom-p">
                            <img src="source/post1 image.jpg" alt="">
                            <div class="repost-info">
                                <div class="repost-img">
                                    <img src="source/photo.webp" alt="writer">
                                </div>
                                <div class="repost-writer">
                                    <p><span><a href="#">Alexa linkin </a></span> <span><a href="#"> . Follow</a></span></p>
                                    <p>Published in <span><a href="#">Developoment</a></span> <span> . Mar 12 2024</span></p>
                                </div>
                            </div>
                            <div class="recom-p-title">
                                <p><a href="singleblog.html">Stop Listening to Music, It Will Change Your Life</a></p>
                            </div>
                            <div class="recom-p-details">
                                <p><a href="singleblog.html">I stopped listening to music, find out what the results and benefits are in this post!</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="recommended">
                        <div class="recom-p">
                            <img src="source/post1 image.jpg" alt="">
                            <div class="repost-info">
                                <div class="repost-img">
                                    <img src="source/photo.webp" alt="writer">
                                </div>
                                <div class="repost-writer">
                                    <p><span><a href="#">Alexa linkin </a></span> <span><a href="#"> . Follow</a></span></p>
                                    <p>Published in <span><a href="#">Developoment</a></span> <span> . Mar 12 2024</span></p>
                                </div>
                            </div>
                            <div class="recom-p-title">
                                <p><a href="singleblog.html">Stop Listening to Music, It Will Change Your Life</a></p>
                            </div>
                            <div class="recom-p-details">
                                <p><a href="singleblog.html">I stopped listening to music, find out what the results and benefits are in this post!</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="recommended">
                        <div class="recom-p">
                            <img src="source/post1 image.jpg" alt="">
                            <div class="repost-info">
                                <div class="repost-img">
                                    <img src="source/photo.webp" alt="writer">
                                </div>
                                <div class="repost-writer">
                                    <p><span><a href="#">Alexa linkin </a></span> <span><a href="#"> . Follow</a></span></p>
                                    <p>Published in <span><a href="#">Developoment</a></span> <span> . Mar 12 2024</span></p>
                                </div>
                            </div>
                            <div class="recom-p-title">
                                <p><a href="singleblog.html">Stop Listening to Music, It Will Change Your Life</a></p>
                            </div>
                            <div class="recom-p-details">
                                <p><a href="singleblog.html">I stopped listening to music, find out what the results and benefits are in this post!</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="recommended">
                        <div class="recom-p">
                            <img src="source/post1 image.jpg" alt="">
                            <div class="repost-info">
                                <div class="repost-img">
                                    <img src="source/photo.webp" alt="writer">
                                </div>
                                <div class="repost-writer">
                                    <p><span><a href="#">Alexa linkin </a></span> <span><a href="#"> . Follow</a></span></p>
                                    <p>Published in <span><a href="#">Developoment</a></span> <span> . Mar 12 2024</span></p>
                                </div>
                            </div>
                            <div class="recom-p-title">
                                <p><a href="singleblog.html">Stop Listening to Music, It Will Change Your Life</a></p>
                            </div>
                            <div class="recom-p-details">
                                <p><a href="singleblog.html">I stopped listening to music, find out what the results and benefits are in this post!</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>

            <div class="reg-blog2">
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
            </div>

            <div class="space">
                <p></p>
            </div>
    </main>

</template>

<script>
export default {
    data(){
        return {
           form: {
                title:null,
                cat_id:null,
                short_description:null,
                long_description:null,
                Images:null,
             },

        }
    },
    methods:{


       getunionInfo(id=''){

                axios.get(`/api/update/blog/${id}`)
                .then((res)=>{

                    this.form = res.data
                })

        },



    },
    mounted(){
        if(this.$route.params.slug){
           this.getunionInfo(this.$route.params.slug);
        }

        }
}
</script>

