<template>
        <div class="card">
        <div class="card-body">
    <b-container fluid>
        <!-- User Interface controls -->
        <b-row>
            <b-col lg="6" class="my-1" v-if="SortOptionsStaus">
                <b-form-group label="Sort" label-for="sort-by-select" label-cols-sm="3" label-align-sm="right"
                    label-size="sm" class="mb-0" v-slot="{ ariaDescribedby }">
                    <b-input-group size="sm">
                        <b-form-select id="sort-by-select" v-model="sortBy" :options="sortOptions"
                            :aria-describedby="ariaDescribedby" class="w-75">
                            <template #first>
                                <option value="">-- none --</option>
                            </template>
                        </b-form-select>

                        <b-form-select v-model="sortDesc" :disabled="!sortBy" :aria-describedby="ariaDescribedby"
                            size="sm" class="w-25">
                            <option :value="false">Asc</option>
                            <option :value="true">Desc</option>
                        </b-form-select>
                    </b-input-group>
                </b-form-group>
            </b-col>

            <b-col lg="6" class="my-1" v-if="SortOptionsStaus">
                <b-form-group label="Initial sort" label-for="initial-sort-select" label-cols-sm="3"
                    label-align-sm="right" label-size="sm" class="mb-0">
                    <b-form-select id="initial-sort-select" v-model="sortDirection" :options="['asc', 'desc', 'last']"
                        size="sm"></b-form-select>
                </b-form-group>
            </b-col>

            <b-col lg="6" class="my-1" v-if="Filter">
                <b-form-group label="Filter" label-for="filter-input" label-cols-sm="3" label-align-sm="right"
                    class="mb-0">
                    <b-input-group >
                        <b-form-input id="filter-input" v-model="filter" type="search" placeholder="Type to Search">
                        </b-form-input>

                        <b-input-group-append>
                            <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>

            <b-col lg="6" class="my-1" v-if="FilterOn">
                <b-form-group v-model="sortDirection" label="Filter On"
                    description="Leave all unchecked to filter on all data" label-cols-sm="3" label-align-sm="right"
                    label-size="sm" class="mb-0" v-slot="{ ariaDescribedby }">
                    <b-form-checkbox-group v-model="filterOn" :aria-describedby="ariaDescribedby" class="mt-1">
                        <b-form-checkbox value="name">Name</b-form-checkbox>
                        <b-form-checkbox value="age">Age</b-form-checkbox>
                        <b-form-checkbox value="isActive">Active</b-form-checkbox>
                    </b-form-checkbox-group>
                </b-form-group>
            </b-col>

            <b-col sm="5" md="6" class="my-1" v-if="PerPage">
                <b-form-group label="Per page" label-for="per-page-select" label-cols-sm="6" label-cols-md="4"
                    label-cols-lg="3" label-align-sm="right" label-size="sm" class="mb-0">
                    <b-form-select id="per-page-select" v-model="perPage" :options="pageOptions" size="sm">
                    </b-form-select>
                </b-form-group>
            </b-col>


        </b-row>

        <!-- Main table element -->
        <b-table :items="Items" :fields="Fields" :current-page="currentPage" :per-page="PerPageData" :filter="filter"
            :filter-included-fields="filterOn" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc"
            :sort-direction="sortDirection" stacked="md" show-empty small @filtered="onFiltered">


           <template #cell(time)="row">
            <timeago :datetime="row.item.created_at" :auto-update="5"></timeago>
            </template>

            <template #cell(actions)="row">



                <b-button size="sm" @click="deletefun(row.item, row.index, $event.target)" v-if="DeleteRoute!=''" class="btn btn-danger mr-1">
                    DELETE
                </b-button>

                <b-button size="sm" @click="info(row.item, row.index, $event.target)" v-if="ViewRoute!=''" class="btn btn-info mr-1">
                    VIEW
                </b-button>

                <b-button size="sm" @click="edit(row.item, row.index, $event.target)" v-if="EditRoute!=''" class="btn btn-success mr-1">
                    EDIT
                </b-button>

                <span size="sm" @click="cancel(CancelRoute, row.item.id, Canceltext, $event.target)"
                    v-if="CancelRoute != '' && row.item.status!='banned'" class="btn btn-danger mr-1 mt-1">
                   {{ Canceltext.toUpperCase() }}
                </span>

                <span size="sm" @click="cancel(CancelRoute, row.item.id, 'active', $event.target)"
                    v-else-if="CancelRoute != '' && row.item.status=='banned'" class="btn btn-success mr-1 mt-1">
                   RESTORE
                </span>
<!--
                <router-link size="sm" :to="{name:EditRoute,params:{id:row.item.id}}"  v-if="EditRoute!=''" class="btn btn-info mr-1">
                    Edit
                </router-link> -->

                <!-- <router-link size="sm" :to="{name:ViewRoute,params:{id:row.item.id}}"  v-if="ViewRoute!=''" class="btn btn-success mr-1">
                    View
                </router-link> -->

                <!-- <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="btn btn-success mr-1">
                    View
                </b-button> -->
                <!-- <b-button size="sm" @click="row.toggleDetails">
                    {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
                </b-button> -->
            </template>

            <template #row-details="row">
                <b-card>
                    <ul>
                        <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
                    </ul>
                </b-card>
            </template>



        </b-table>






    <b-pagination
      v-model="currentPage"
      :total-rows="TotalRows"
      :per-page="PerPageData"
      first-text="First"
      prev-text="Prev"
      next-text="Next"
      last-text="Last"
      align="right"
    ></b-pagination>





        <!-- Info modal -->
        <b-modal :id="editModal.id" size="xl"  ok-only @hide="resetInfoModal">
                       <UserForm v-if="Table=='users'"></UserForm>
        </b-modal>

        <!-- Info modal -->
        <b-modal :id="infoModal.id" size="xl"  ok-only @hide="resetInfoModal">
            <!-- <pre>{{ infoModal.content }}</pre> -->

                <UserView v-if="Table=='users'" :Details="infoModal.content"></UserView>

        </b-modal>

    </b-container>
        </div>
        </div>
</template>

<script>
export default {
    props: {
        Table: {
            type: String,
            default: ''
        },
        SonodType: {
            type: String,
            default: ''
        },
        AllUpdate: {
            type: String,
            default: ''
        },
        Canceltext: {
            type: String,
            default: ''
        },
        AddNew: {
            type: String,
            default: ''
        },
        SortOptionsStaus: {
            type: Boolean,
            default: false
        },
        Filter: {
            type: Boolean,
            default: false
        },
        FilterOn: {
            type: Boolean,
            default: false
        },
        PerPage: {
            type: Boolean,
            default: false
        },
        SelectOption: {
            type: Boolean,
            default: false
        },
        Items: {
            type: Array,
            default: [],
        },
        Fields: {
            type: Array,
            default: [],
        },
        PerPageData: {
            type: String,
            default: 10,
        },
        TotalRows: {
            type: String,
            default: 1,
        },
        DeleteRoute: {
            type: String,
            default: '',
        },
        EditRoute: {
            type: String,
            default: '',
        },
        ViewRoute: {
            type: String,
            default: '',
        },
        ApplicationRoute: {
            type: String,
            default: '',
        },
        ApproveRoute: {
            type: String,
            default: '',
        },
        PayRoute: {
            type: String,
            default: '',
        },
        ApproveData: {
            type: String,
            default: 'approved',
        },
        ApproveType: {
            type: String,
            default: 'apiAction',
        },
        CancelRoute: {
            type: String,
            default: '',
        },
        ApproveComponent: {
            type: String,
            default: '',
        }
    },

    data() {
        return {
            // totalRows: 1,
            currentPage: 1,
            perPage: 5,
            // pageOptions: [5, 10, 15, { value: 100, text: "Show a lot" }],
            sortBy: '',
            sortDesc: false,
            sortDirection: 'asc',
            filter: null,
            filterOn: [],
            infoModal: {
                id: 'info-modal',
                title: '',
                content: ''
            },
            editModal: {
                id: 'edit-modal',
                title: '',
                content: ''
            }
        }
    },
    computed: {
        sortOptions() {
            // Create an options list from our fields
            return this.Fields
                .filter(f => f.sortable)
                .map(f => {
                    return { text: f.label, value: f.key }
                })
        }
    },
    mounted() {
        // Set the initial number of items
        // this.totalRows = this.Items.length




    },
    methods: {
        info(item, index, button) {
            this.infoModal.title = `Row index: ${index}`
            this.infoModal.content = JSON.stringify(item, null, 2)
            this.$root.$emit('bv::show::modal', this.infoModal.id, button)
        },
        edit(item, index, button) {
            this.editModal.title = `Row index: ${index}`
            this.editModal.content = JSON.stringify(item, null, 2)
            this.$root.$emit('bv::show::modal', this.editModal.id, button)
        },
        resetInfoModal() {
            this.infoModal.title = ''
            this.infoModal.content = ''
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            // this.totalRows = filteredItems.length
            this.currentPage = 1
        },

         deletefun(item, index, event){
            // console.log('item: '+item.id, 'index: '+index, 'event: '+event)




			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: `Yes, ${this.action} it!`
			}).then(async (result) => {
				if (result.isConfirmed) {



            var res = await this.callApi('delete',`${this.DeleteRoute}/${item.id}`,[]);
      Notification.customdelete(`Your data has been Deleted!`);
            this.$emit('event-name')



				}
			})







        },
       async cancel(route, id, status, button) {


            Swal.fire({
                title: 'Are you sure?',
                text: `${status} this Data!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Yes, ${status} it!`
            }).then(async (result) => {
                if (result.isConfirmed) {
                    var res = await this.callApi('get', `${route}/${status}/${id}`, []);
                    Notification.customSuccess(`Your data has been ${status} Success`);
                    this.$emit('event-name')
                }
            })

        },

    }
}
</script>
