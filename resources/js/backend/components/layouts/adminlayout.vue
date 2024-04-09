<template>
    <div id="wrapper" class="wrapper bg-ash"
        :class="{ 'sidebar-collapsed': sidebarstatus, 'sidebar-collapsed-mobile': mobileSidebar }">
        <!-- Header Menu Area Start Here -->
        <div class="navbar navbar-expand-md header-menu-one bg-light" id='topnavbar'>
            <div class="nav-bar-header-one">
                <div class="header-logo">
                    <router-link :to="{name:'Dashboard'}">
                        <img width="150" src="http://esoft4u.tmscedu.com/asset/img/Logo123.png" alt="logo">
                    </router-link>
                </div>
                <div class="toggle-button sidebar-toggle">
                    <button type="button" class="item-link" @click="sidebarstatus = !sidebarstatus">
                        <span class="btn-icon-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="d-md-none mobile-nav-bar">
                <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse"
                    data-target="#mobile-navbar" aria-expanded="false">
                    <i class="far fa-arrow-alt-circle-down"></i>
                </button>
                <button type="button" class="navbar-toggler sidebar-toggle-mobile"
                    @click="mobileSidebar = !mobileSidebar">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
                <ul class="navbar-nav">
                    <li class="navbar-item header-search-bar">
                        <div class="input-group stylish-input-group">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="flaticon-search" aria-hidden="true"></span>
                                </button>
                            </span>
                            <input type="text" class="form-control" placeholder="Find Something . . .">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="navbar-item dropdown header-admin">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="admin-title">
                                <h5 class="item-title">{{ user.name }}</h5>
                                <!-- <span>{{ permission.roleName }}</span> -->
                            </div>
                            <div class="admin-img">
                                <img :src="$asseturl + 'dashboard_asset/img/figure/admin.jpg'" alt="Admin">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">{{ $localStorage.getItem('user') }}</h6>
                            </div>
                            <div class="item-content">
                                <ul class="settings-list">
                                    <li><a href="#"><i class="flaticon-user"></i>My Profile</a></li>
                                    <li><a href="#"><i class="flaticon-gear-loading"></i>Account Settings</a></li>
                                    <li>
                                        <router-link class="dropdown-item" :to="{name:'logout'}">
                                            <i class="flaticon-turn-off"></i> Logout
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <!-- <li class="navbar-item dropdown header-message">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="far fa-envelope text-white"></i>
                            <div class="item-title d-md-none text-16 mg-l-10">Message</div>
                            <span>5</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">05 Message</h6>
                            </div>
                            <div class="item-content">
                                <div class="media">
                                    <div class="item-img bg-skyblue author-online">
                                        <img src="img/figure/student11.png" alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Maria Zaman</span>
                                                <span class="item-time">18:30</span>
                                            </a>
                                        </div>
                                        <p>What is the reason of buy this item.
                                        Is it usefull for me.....</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-img bg-yellow author-online">
                                        <img src="img/figure/student12.png" alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Benny Roy</span>
                                                <span class="item-time">10:35</span>
                                            </a>
                                        </div>
                                        <p>What is the reason of buy this item.
                                        Is it usefull for me.....</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-img bg-pink">
                                        <img src="img/figure/student13.png" alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Steven</span>
                                                <span class="item-time">02:35</span>
                                            </a>
                                        </div>
                                        <p>What is the reason of buy this item.
                                        Is it usefull for me.....</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="item-img bg-violet-blue">
                                        <img src="img/figure/student11.png" alt="img">
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="item-title">
                                            <a href="#">
                                                <span class="item-name">Joshep Joe</span>
                                                <span class="item-time">12:35</span>
                                            </a>
                                        </div>
                                        <p>What is the reason of buy this item.
                                        Is it usefull for me.....</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li> -->
                    <!-- <li class="navbar-item dropdown header-notification">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="far fa-bell text-white"></i>
                            <div class="item-title d-md-none text-16 mg-l-10">Notification</div>
                            <span>{{ nT.itemsC }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">{{ nT.itemsC }} Notifiacations</h6>
                            </div>
                            <div class="item-content">
                                <div class="media" v-for="nTs in nT.items" :key="'nTs'+nTs.id">
                                    <div class="item-icon bg-skyblue">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <div class="post-title">{{ nTs.title }}</div>
                                        <span>   <timeago :datetime="nTs.created_at" :auto-update="5"></timeago></span>
                                    </div>
                                </div>

                                <div class="media">
                                    <router-link style="    width: 100%;
    text-align: center;
    font-size: 15px;
    border: 1px solid var(--bgColor1);
    color: var(--bgColor1);" :to="{name:'notificatoins'}">See All</router-link>
                                </div>

                            </div>
                        </div>
                    </li>
                     <li class="navbar-item dropdown header-language">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-expanded="false"><i class="fas fa-globe-americas"></i>EN</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">English</a>
                            <a class="dropdown-item" href="#">Spanish</a>
                            <a class="dropdown-item" href="#">Franchis</a>
                            <a class="dropdown-item" href="#">Chiness</a>
                        </div>
                    </li> -->


                </ul>
            </div>
        </div>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
                <div class="mobile-sidebar-header d-md-none">
                    <div class="header-logo">
                        <a href="/" style="    padding: 10px !important;"><img width="150" src="http://esoft4u.tmscedu.com/asset/img/Logo123.png" alt="logo"></a>
                    </div>
                </div>
                <div class="sidebar-menu-content" id="dashboardheight">
                    <ul class="nav nav-sidebar-menu sidebar-toggle-view navBar">





                        <li  @click="submenu(0)"  class="nav-item">
                            <router-link :to="{name:'Dashboard'}" class="nav-link"><i class="flaticon-dashboard"></i><span>Dashboard</span></router-link>
                        </li>


                        <li  @click="submenu(0)"  class="nav-item">
                            <router-link :to="{name:'nid_document'}" class="nav-link"><i class="flaticon-dashboard"></i><span>Nid Document</span></router-link>
                        </li>


                        <li  @click="submenu(0)"  class="nav-item">
                            <router-link :to="{name:'paymentl'}" class="nav-link"><i class="flaticon-dashboard"></i><span>Payments</span></router-link>
                        </li>



                        <li  @click="submenu(0)"  class="nav-item"   v-if="$localStorage.getItem('role')=='admin' || $localStorage.getItem('role')=='agent'">
                            <router-link :to="{name:'Userslist',params:{status:'active'}}" class="nav-link"><i class="flaticon-dashboard"></i><span>Users</span></router-link>
                        </li>


                        <li  @click="submenu(0)"  class="nav-item"   v-if="$localStorage.getItem('role')=='admin' || $localStorage.getItem('role')=='agent'">
                            <router-link :to="{name:'Usersform'}" class="nav-link"><i class="flaticon-dashboard"></i><span>Add User</span></router-link>
                        </li>




                         <li class="nav-item sidebar-nav-item" :class="{ active: selected == 101 }"  v-if="$localStorage.getItem('role')=='admin'">
                            <a href="javascript:void(0)" class="nav-link" @click="submenu(101)"><i
                                    class="flaticon-technological"></i><span>Blogs</span>
                            </a>
                            <transition name="slide">
                                <ul class="nav sub-group-menu menu-open child" v-if="selected == 101"
                                    style="display:block">

                                    <li class="nav-item">
                                        <router-link :to="{ name: 'category' }" class="nav-link"><i
                                                class="fas fa-angle-right"></i> Category </router-link>
                                    </li>

                                    <li class="nav-item">
                                        <router-link :to="{ name: 'blogs' }" class="nav-link"><i
                                                class="fas fa-angle-right"></i> Blogs </router-link>
                                    </li>


                                </ul>
                            </transition>
                        </li>

<!--
                        <li  @click="submenu(0)"  class="nav-item">
                            <router-link :to="{name:'featured_post'}" class="nav-link"><i class="flaticon-dashboard"></i><span>Featured Post</span></router-link>
                        </li> -->



                        <!-- <li class="nav-item sidebar-nav-item" :class="{ active: selected == 1 }">
                            <a href="javascript:void(0)" class="nav-link" @click="submenu(1)" ref="Acconunt"><i
                                    class="flaticon-technological"></i><span>Manage Users</span></a>
                            <transition name="slide">
                                <ul class="nav sub-group-menu menu-open child" v-if="selected == 1"
                                    style="display:block">
                                    <li class="nav-item"><router-link :to="{name:'Userslist', params:{status:'all'}}" class="nav-link"><i class="fas fa-angle-right"></i> All Users</router-link></li>
                                    <li class="nav-item"><router-link :to="{name:'Userslist', params:{status:'active'}}" class="nav-link"><i class="fas fa-angle-right"></i> Active Users</router-link></li>
                                    <li class="nav-item"><router-link :to="{name:'Userslist', params:{status:'banned'}}" class="nav-link"><i class="fas fa-angle-right"></i> Banned Users</router-link></li>
                                </ul>
                            </transition>
                        </li> -->
<!--
                        <li v-for="(menuList,index) in userPermission" class="nav-item" @click="submenu(index)" v-if="menuList.read">
                            <router-link :to="{name:menuList.name}" class="nav-link"><i
                                    class="flaticon-dashboard"></i><span>{{ menuList.resourceName }}</span></router-link>
                        </li>
 -->



                        <!-- <li class="nav-item sidebar-nav-item" :class="{ active: selected == 1 }">
                            <a href="javascript:void(0)" class="nav-link" @click="submenu(1)" ref="Acconunt"><i
                                    class="flaticon-technological"></i><span>Acconunt</span></a>
                            <transition name="slide">
                                <ul class="nav sub-group-menu menu-open child" v-if="selected == 1"
                                    style="display:block">
                                    <li class="nav-item">
                                        <router-link to="/school/payment" class="nav-link"><i
                                                class="fas fa-angle-right"></i> Payments</router-link>
                                    </li>
                                </ul>
                            </transition>
                        </li>
 -->



                    </ul>
                </div>
            </div>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <slot></slot>
                <!-- Footer Area Start Here -->
                <!-- <footer class="footer-wrap-layout1">
                    <div class="copyright">© Copyrights <a href="#">Company name</a> 2019. All rights reserved. Developed by <a target="_blank"
                            href="https://api.whatsapp.com/send?phone=8801909756552&text=I%27m%20interested%20in%20your%20services">Freelancer Nishad</a></div>
                </footer> -->
                <!-- Footer Area End Here -->
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
</template>
<script>
export default {
     props: ['user','permission','roles'],
    created() {

        localStorage.setItem('usertoken',this.user.token);
        localStorage.setItem('userid',this.user.id);
        localStorage.setItem('role',this.user.role);



		if (!User.loggedIn()) {
			window.location.href = '/'
		}



       this.$store.commit('setUpdateUser', this.user)
    //    this.$store.commit('setAuthPermission', this.permission)
    //    this.$store.commit('setUserPermission', JSON.parse(this.permission.permission))
    //    this.$store.commit('setUserRoles', this.roles)



//  this.$store.dispatch("getUser",this.user);


        if (localStorage.getItem('selectedMenu')) {
            this.selected = localStorage.getItem('selectedMenu')
        }
        window.addEventListener("resize", this.myEventHandler);
        window.addEventListener("scroll", this.myscroll);

    },
    destroyed() {
        window.removeEventListener("resize", this.myEventHandler);
        window.removeEventListener("scroll", this.myscroll);
    },
    data() {
        return {
            selected: 0,
            sidebarstatus: false,
            mobileSidebar: false,
        }
    },

    watch: {
        '$route': {
            handler(newValue, oldValue) {
                localStorage.setItem('userid',this.user.id);
                localStorage.setItem('role',this.user.role);
            },
            deep: true
        }
    },

    methods: {

        myscroll(){



// Get the header
var header = document.getElementById("topnavbar");

var sticky = header.offsetTop;


  if (window.pageYOffset > sticky) {
    header.classList.add("fixednav");
  } else {
    header.classList.remove("fixednav");
  }



        },

        myEventHandler() {
            if (window.innerWidth > 768) {
                this.sidebarstatus = false
            } else {
                this.mobileSidebar = false
            }


            // var index = 1
            // if(localStorage.getItem('role')=='admin' || localStorage.getItem('role')=='teacher'){
            //     index= 0
            // }
                var clientHeight = document.getElementsByClassName('navBar')[0].clientHeight;

            var menuheight = 0
            if(clientHeight<window.innerHeight){
                menuheight= window.innerHeight
            }else{
                menuheight= '100%'
            }
            document.getElementById('wrapper').style.height = menuheight +'px';
            document.getElementById('dashboardheight').style.height = menuheight +'px';










        },
        submenu(ref) {

            if (this.selected > 0) {
                if (ref == this.selected) {
                    this.selected = 0
                    localStorage.setItem('selectedMenu', 0)
                } else {
                    this.selected = ref
                    localStorage.setItem('selectedMenu', ref)
                }
            } else {
                this.selected = ref
                localStorage.setItem('selectedMenu', ref)
            }
        }
    },
    mounted() {
        this.myEventHandler();
    }
}
</script>
<style>
ul.nav.sub-group-menu.menu-open.child {
    padding: 0 !important;
}
ul.nav.sub-group-menu.menu-open.child li {
    padding: 10px 0;
}
.slide-enter-active {
    -moz-transition-duration: 0.3s;
    -webkit-transition-duration: 0.3s;
    -o-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -moz-transition-timing-function: ease-in;
    -webkit-transition-timing-function: ease-in;
    -o-transition-timing-function: ease-in;
    transition-timing-function: ease-in;
}
.slide-leave-active {
    -moz-transition-duration: 0.3s;
    -webkit-transition-duration: 0.3s;
    -o-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -moz-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    -webkit-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    -o-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
}
.slide-enter-to,
.slide-leave {
    max-height: 100px;
    overflow: hidden;
}
.slide-enter,
.slide-leave-to {
    overflow: hidden;
    max-height: 0;
}
</style>
