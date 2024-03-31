<template>
   <main>
        <!-- banner -->
        <div class="banner1">
            <div class="banner">
                <div class="bsite1">
                    <img class="bimg" src="source/banner.png" alt="">
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
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="pbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
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
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="pbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
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
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="pbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
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
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="pbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
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
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="pbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
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
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="pbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
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
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Advice to my younger self and you after 20 years in programming</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <a href="#"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></a>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
                <div class="reg-blog-post">
                    <div class="rblog1">
                            <p class="rb-category"><router-link :to="{name:'singleblog',params:{slug:'slug'}}"><i class="fa-solid fa-outdent"></i> UX Collective</router-link></p>
                            <p class="rb-title"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">90% of designers are unhirable?</router-link></p>
                            <p class="rb-paragraph"><router-link :to="{name:'singleblog',params:{slug:'slug'}}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi perspiciatis dolor unde, doloribus optio harum modi officiis nesciunt ratione maiores?</router-link></p>
                            <p class="rb-date"><i class="fa-solid fa-calendar-days"></i> Mar 6, 2024</p>
                    </div>
                    <div class="rbblog2">
                            <div>
                                <router-link :to="{name:'singleblog',params:{slug:'slug'}}"><img class="rbimg" src="source/blog-img.jpg" alt="blog image"></router-link>
                            </div>
                    </div>
                </div>
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
