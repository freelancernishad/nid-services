import { mapGetters } from 'vuex'
export default {

    data(){
        return {
            nT:{},
            PaginateRows:20,
            Totalrows:0,
            PerPageData:0,
            Totalpage:[],
            Routename:'',
            Routeparams:{},

        }
    },
    methods: {
        async callApi(method, url, dataObj ){

            const headers = { Authorization: `Bearer ${localStorage.getItem('token')}` };
            try {
              return await axios({
                    method: method,
                    url: url,
                    data: dataObj,
                    headers:headers
                });
            } catch (e) {
                return e.response
            }
        },



        async callApiPaginate(url,page){
            var res = await this.callApi('get',`${url}`,[]);
            this.PaginateRows = res.data.per_page
            this.Totalrows = res.data.total
            this.Totalpage = res.data.links
            this.PerPageData = res.data.per_page
            this.Routename = 'categoryIndex'
            this.Routeparams = {}
            if(page==1){
                this.pageNO = 1;
            }else{
                this.pageNO = (page-1)*this.PerPageData+1;
            }
            if(res.data.last_page<page){
                this.$router.push({name:this.Routename,query:{page:res.data.last_page}});
            }
            return  res.data.data;

        },

        checkUserPermission(key){
            if(!this.userPermission) return true
            let isPermitted = false;
            for(let d of this.userPermission){
                if(this.$route.name==d.name){
                    if(d[key]){
                        isPermitted = true
                        break;
                    }else{
                        break
                    }
                }

            }
            return isPermitted
            // return this.$route.name;
        },




    },
    computed: {

        // Users(){
        //     return this.$store.getters.setUpdateUser;
        // }

        ...mapGetters({
            'Users' : 'getUpdateUser',
            'getlatestpost' : 'getlatestpost',
            // 'userPermission' : 'getUserPermission',
            // 'getAuthPermission' : 'getAuthPermission',
            // 'getUserRoles' : 'getUserRoles',
        }),

        // isReadPermitted(){
        //     return this.checkUserPermission('read')
        //  },
        //  isWritePermitted(){
        //      return this.checkUserPermission('write')
        //  },
        //  isUpdatePermitted(){
        //      return this.checkUserPermission('update')
        //  },
        //  isDeletePermitted(){
        //      return this.checkUserPermission('delete')
        //  },

    },




}
