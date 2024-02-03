<template>
    <div>


<div class="breadcrumbs-area">
    <h3>List</h3>
    <ul>
        <li>
            <router-link :to="{name:'Dashboard'}">Home</router-link>
        </li>
        <li>List</li>
    </ul>
</div>





<div class="card">
    <div class="card-header">
                <router-link :to="{name:'nid_document'}" class="btn btn-info">Go Search</router-link>
            </div>
        <div class="card-body">

<table class="table">

    <thead>
        <tr>
            <th>Sl</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Short Description</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <tr v-for="(item,index) in items.data" :key="index">
            <td>{{ index+pageNO }}</td>
            <td>{{ item.title }}</td>
            <td>{{ item.slug }}</td>
            <td>{{ item.short_description }}</td>
            <td><router-link :to="{name:'blogedit',params:{id:item.id}}" class="btn btn-info">Edit</router-link></td>
        </tr>
    </tbody>



</table>

        </div>


                <div class="card-footer">
                        <Pagination :total-rows="TotalRows" :route-name="RouteName" :route-params="RouteParams" :total-page="Totalpage"></Pagination>
                    </div>

            </div>



        </div>
</template>

<script>

export default {

     computed: {



    },
    created() {


    },
    data() {
        return {

            preLooding:false,
            items: {},

            PerPageData: '20',
            TotalRows: '1',
            Totalpage: [],
            RouteName:'blogs',
            RouteParams:{},
            pageNO: 1,


        }
    },
    // updated(){

    //  this.sonodList();

    // },

  watch: {
        '$route':  {
            handler(newValue, oldValue) {

        // hello


      },
      deep: true



        }
    },

    methods: {


       async blogsList(){

            this.preLooding = true
            var page = 1;
            if (this.$route.query.page) page = this.$route.query.page;

            var res = await this.callApi('get',`/api/get/blog/list?page=${page}`,[]);
            this.items = res.data
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
    mounted() {

        this.blogsList();


    }


}
</script>
