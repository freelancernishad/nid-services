<template>
    <div>
        <!-- <loader v-if="preLooding" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" name="circular"></loader>-->

        <preloader  v-if="preLooding"/>

        <Breadcrumbs brename="Payment List"/>


        <div class="card">
            <div class="card-header">

                <router-link :to="{name:'paymentf'}" class="btn btn-success">Add Balance</router-link>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th v-if="$localStorage.getItem('role')=='admin'">User Id </th>
                                <th v-if="$localStorage.getItem('role')=='admin'">Name </th>
                                <th v-if="$localStorage.getItem('role')=='admin'">Email </th>
                                <th>Trx Id</th>
                                <th>Method</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th v-if="$localStorage.getItem('role')=='admin'">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(list,index) in lists" :key="index">
                                <td>{{ index+pageNO }}</td>
                                <td v-if="$localStorage.getItem('role')=='admin'">{{ list.user.id }}</td>
                                <td v-if="$localStorage.getItem('role')=='admin'">{{ list.user.name }}</td>
                                <td v-if="$localStorage.getItem('role')=='admin'">{{ list.user.email }}</td>
                                <td>{{ list.trxid }}</td>
                                <td>{{ list.method }}</td>
                                <td>{{ list.date }}</td>
                                <td>{{ list.amount }}</td>
                                <td>{{ list.status }}</td>
                                <td  v-if="$localStorage.getItem('role')=='admin'">

                                    <button @click="approvePayment(list.id,'cancel')" class="btn btn-danger" v-if="list.status=='Pending' || list.status=='approved'">Cancel</button>
                                    <button @click="approvePayment(list.id)" class="btn btn-success" v-if="list.status=='Pending' || list.status=='Canceled'">Approve</button>

                                    <!-- <router-link class="btn btn-info" :to="{name:'pagesEdit',params:{id:list.id}}">Edit</router-link> -->
                                    <!-- <button class="btn btn-danger" @click="DeleteAction('Are you sure?','Delete this pages',`/api/galleries/${list.id}`,'Pages Deleted',getLists)">Delete</button> -->

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">

                <Paginate :Paginaterowsprops="PaginateRows" :Totalrowsprops="Totalrows" :Totalpageprops="Totalpage" :Routenameprops="Routename" :Routeparamsprops="Routeparams"/>

            </div>
        </div>



    </div>
</template>

<script>
export default {
    data() {
        return {
            lists:{},
            pageNO:1,
            preLooding:false,
        }
    },
    watch: {
        '$route': {
            handler(newValue, oldValue) {
                this.getLists();
            },
            deep: true
        }
    },
    methods: {

        async approvePayment(id,action=''){
            this.preLooding = true
            var res = await this.callApi('get',`/api/payments/approve/${id}?action=${action}`,[]);
            console.log(res)
            this.getLists();
            this.preLooding = false
        },



        async getLists(page=1){
            this.preLooding = true
            if(this.$route.query.page){
                page = this.$route.query.page;
            }


            var res = await this.callApiPaginate(`/api/payments/user/${localStorage.getItem('userid')}?page=${page}&role=${localStorage.getItem('role')}`,page);

            // console.log(res)
            this.lists = res
            this.preLooding = false


        }
    },
    mounted() {
        this.getLists();
    },
}
</script>
