<template>
    <div>

        <preloader  v-if="preLooding"/>
        <Breadcrumbs brename="ড্যাশবোর্ড"/>




                <div class="row gutters-20">


                    <div class="col-lg-3 col-sm-6 col-12"  v-if="$localStorage.getItem('role')=='admin'">
                        <div class="card dashboard-card-seven">
                            <div class="social-media bg-fb hover-fb">
                                <div class="media media-none--lg">
                                    <div class="social-icon">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <h6 class="item-title">Total Member</h6>
                                    </div>
                                </div>
                                <div class="social-like">{{ stats.totalmember }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12"  v-if="$localStorage.getItem('role')=='admin'">
                        <div class="card dashboard-card-seven">
                            <div class="social-media bg-fb hover-fb">
                                <div class="media media-none--lg">
                                    <div class="social-icon">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <h6 class="item-title">Total Admin</h6>
                                    </div>
                                </div>
                                <div class="social-like">{{ stats.totaladmin }}</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-sm-6 col-12"  v-if="$localStorage.getItem('role')=='admin'">
                        <div class="card dashboard-card-seven">
                            <div class="social-media bg-fb hover-fb">
                                <div class="media media-none--lg">
                                    <div class="social-icon">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <h6 class="item-title">Total Agent</h6>
                                    </div>
                                </div>
                                <div class="social-like">{{ stats.totalagent }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12"  v-if="$localStorage.getItem('role')=='admin'">
                        <div class="card dashboard-card-seven">
                            <div class="social-media bg-fb hover-fb">
                                <div class="media media-none--lg">
                                    <div class="social-icon">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <h6 class="item-title">Total Users</h6>
                                    </div>
                                </div>
                                <div class="social-like">{{ stats.totalusers }}</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-sm-6 col-12"  v-if="$localStorage.getItem('role')=='admin'">
                        <div class="card dashboard-card-seven">
                            <div class="social-media bg-fb hover-fb">
                                <div class="media media-none--lg">
                                    <div class="social-icon">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <h6 class="item-title">Nid Porichoy Balance</h6>
                                    </div>
                                </div>
                                <div class="social-like">{{ stats.mainbalance }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12"  v-if="$localStorage.getItem('role')=='agent'">
                        <div class="card dashboard-card-seven">
                            <div class="social-media bg-fb hover-fb">
                                <div class="media media-none--lg">
                                    <div class="social-icon">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <h6 class="item-title">Total Users</h6>
                                    </div>
                                </div>
                                <div class="social-like">{{ stats.totalForThisAgent }}</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-sm-6 col-12" v-if="$localStorage.getItem('role')!='agent'">
                        <div class="card dashboard-card-seven">
                            <div class="social-media bg-fb hover-fb">
                                <div class="media media-none--lg">
                                    <div class="social-icon">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <h6 class="item-title">Nid Balance</h6>
                                    </div>
                                </div>
                                <div class="social-like">{{ stats.balance }}</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card dashboard-card-seven">
                            <div class="social-media bg-twitter hover-twitter">
                                <div class="media media-none--lg">
                                    <div class="social-icon">
                                        <i class="fa-regular fa-users"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <h6 class="item-title">Total Download</h6>
                                    </div>
                                </div>
                                <div class="social-like">{{ stats.nidSearchedTotal }}</div>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card dashboard-card-seven">
                            <div class="social-media bg-twitter hover-twitter">
                                <div class="media media-none--lg">
                                    <div class="social-icon">
                                        <i class="fa-regular fa-users"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <h6 class="item-title">Today Download</h6>
                                    </div>
                                </div>
                                <div class="social-like">{{ stats.nidSearchedToday }}</div>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card dashboard-card-seven">
                            <div class="social-media bg-twitter hover-twitter">
                                <div class="media media-none--lg">
                                    <div class="social-icon">
                                        <i class="fa-regular fa-users"></i>
                                    </div>
                                    <div class="media-body space-sm">
                                        <h6 class="item-title">Withdrawable Balance</h6>
                                    </div>
                                </div>
                                <div class="social-like">{{ stats.withdrawAbleBalance }}</div>
                            </div>
                        </div>
                    </div>





                </div>







        <!-- <vue-editor v-model="content" /> -->
        <!-- {{ isReadPermitted }} -->


<!-- Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tempus blandit metus vitae consectetur. Aliquam a dolor odio. Sed diam leo, accumsan id libero et, suscipit accumsan lacus. Aenean pretium at arcu nec faucibus. Etiam cursus risus eu justo vulputate blandit. Suspendisse potenti. Sed quis nisl non lectus ultrices mollis et a dui. Ut tincidunt vitae eros ac porta. Morbi et nibh ut dolor dictum lobortis. Cras lorem felis, tincidunt viverra ipsum ut, suscipit consequat nisl. Mauris eget leo ut arcu tincidunt ullamcorper. Quisque imperdiet, erat non sollicitudin ultricies, felis enim laoreet tortor, vitae cursus lectus nibh at nunc. Proin eget nisi ac eros facilisis viverra sit amet id elit. Phasellus consequat sapien auctor massa volutpat finibus. Vestibulum accumsan rutrum mauris, id laoreet magna luctus in. Suspendisse a metus tincidunt, hendrerit risus sed, blandit ipsum.

Etiam vitae massa ut velit posuere mattis. Mauris et consectetur est. Aliquam tincidunt, lorem vel molestie mattis, ex velit finibus erat, vitae luctus massa quam ac mauris. Curabitur fermentum tellus eu ipsum convallis dapibus. Duis accumsan pretium purus a porta. Nam convallis ligula leo, quis rutrum risus blandit id. Vivamus sollicitudin felis eget felis efficitur aliquam. Nullam lectus neque, dignissim quis egestas non, consectetur quis ipsum. Aliquam quis porta libero. Ut condimentum eget dui ut molestie. Donec in nisl vel nisi posuere euismod lobortis id magna. Curabitur eget diam lobortis, tincidunt nisl vel, fringilla tortor. Nulla hendrerit imperdiet consectetur.

Proin dignissim, arcu eget euismod egestas, ligula massa luctus urna, in blandit ante lectus at enim. Proin consectetur faucibus luctus. Aliquam faucibus lacus non risus scelerisque hendrerit eu in felis. Donec consequat elit auctor dui aliquam, at molestie orci ornare. Vestibulum id pharetra nisi, in semper sapien. Donec accumsan eu risus consequat interdum. Mauris lacinia massa metus, consequat elementum nunc tempus eget. Nulla facilisi. In ullamcorper diam ex, non laoreet risus posuere eu. Cras quis ultrices nisi. Nunc a enim eget massa fringilla efficitur in facilisis purus.

Morbi viverra ultricies mollis. Vestibulum tortor erat, lobortis a lobortis ut, faucibus eget dolor. Curabitur lacinia pharetra mauris, id rhoncus lorem posuere in. Cras nec dui rhoncus, tincidunt risus vitae, sollicitudin orci. Nam maximus tellus sed velit tempor, sed blandit sapien interdum. Cras vitae accumsan orci. Donec venenatis facilisis turpis id fermentum. Donec sagittis arcu at sagittis lacinia. Curabitur vel nunc leo. Proin ac arcu egestas, pharetra metus in, aliquam magna. Sed turpis felis, sodales non bibendum et, auctor vel diam. Interdum et malesuada fames ac ante ipsum primis in faucibus.

Praesent nulla arcu, gravida non hendrerit nec, posuere sed lacus. Donec convallis quis tortor vel tristique. Sed dapibus luctus neque, quis semper dolor eleifend eget. Donec sed diam ornare, consequat metus ac, porta nisi. Maecenas dictum vulputate nibh vel tempus. Mauris mi magna, volutpat at facilisis at, dapibus a ex. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat mi eu elit egestas dictum. Praesent massa ligula, bibendum quis vulputate et, vulputate nec odio. Sed tincidunt justo id ex hendrerit congue. Integer sit amet pharetra diam, sit amet dignissim felis. Praesent porta laoreet vestibulum. Nullam id posuere risus. Aliquam erat volutpat. Phasellus eleifend ac eros eget ultrices. Nullam bibendum placerat lacus, ac euismod lectus convallis nec. -->
    </div>
</template>
<script>
// import { mapState,mapActions } from 'vuex';

export default {
computed:{
        // users(){
        //    return this.$store.state.Users
        // }


},
    async created() {
            //   const res = await this.callApi('POST', '/api/user', {});




        // if (!User.loggedIn()) {
        //     this.$router.push({ name: "/login" });
        // }
    },

    data() {
        return {
            content:'',
            stats:{
                mainbalance:0,
                totalmember:0,
                totaladmin:0,
                totalagent:0,
                totalusers:0,
                totalForThisAgent:0,
                balance:0,
                nidSearchedTotal:0,
                nidSearchedToday:0,
                totalSearchesByChild:0,
                todaySearchesByChild:0,
                withdrawAbleBalance:0,
            },
        };
    },
    methods: {
        async loadStats(){



            var res = await this.callApi('get',`/api/get/all/stats?role=${localStorage.getItem('role')}&userid=${localStorage.getItem('usertoken')}`,[]);
            this.stats = res.data;
            var mainBalance = await this.callApi('post',`https://uniontax.xyz/api/main/balance`,[]);
            var balance = mainBalance.data;
            this.stats.mainbalance = balance.credits/2;
        }




    },
    mounted() {


        this.loadStats();
    },
};





</script>
<style lang="css" scoped>

</style>
