<template>
    <div>
        <div class="breadcrumbs-area">
                    <h3>Notifications</h3>
                    <ul>
                        <li>
                            <router-link :to="{name:'Dashboard'}">Home</router-link>
                        </li>
                        <li>Notifications</li>
                    </ul>
                </div>



<table-component :sort-options-staus="sortstatus" :Filter="Filter" :filter-on="FilterOn"  :per-page="PerPage" :Items="items" :Fields="fields" :per-page-data="PerPageData" :total-rows="TotalRows"  delete-route="/api/sonod/delete"  edit-route=""  :view-route="ViewRoute"  @event-name="list" >
</table-component>
    </div>
</template>

<script>

export default {
created() {
    if(this.getAuthPermission.roleName=='admin'){

        this.fields.push({ key: 'actions', label: 'Actions' })
    }
    // console.log(this.getAuthPermission.roleName)

},
  data(){
    return {
            sortstatus:false,
            Filter:true,
            FilterOn:false,
            PerPage:false,
            ViewRoute:'have',
            PerPageData:'10',
            TotalRows:'1',

            fields: [
                { key: 'title', label: 'Title', sortable: true },
                { key: 'time', label: 'Time', sortable: true },

            ],
            items: []
    }
  },
  methods: {

      async list(){
        var res = await this.callApi('get',`/api/admin/notification`,[]);
                  this.items = res.data
                  this.TotalRows = `${this.items.length}`;
        },

    },
    mounted() {
        this.list();

        // this.TotalRows = `${this.items.length}`;
    },
}
</script>

<style lang="css" scoped>

</style>
