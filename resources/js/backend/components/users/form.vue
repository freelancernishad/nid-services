<template>
    <div>

    <preloader  v-if="preLooding"/>

<Breadcrumbs brename="Add New User"/>


    <form @submit.stop.prevent="onSubmit">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group ">
                    <label class="form-control-label font-weight-bold">Name <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" v-model="form.name" value="sa">
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group ">
                    <label class="form-control-label font-weight-bold">Email
                        <span class="text-danger">*</span></label>
                    <input class="form-control" type="email" v-model="form.email" value="">
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group ">
                    <label class="form-control-label font-weight-bold">Password <span
                            class="text-danger">*</span></label>
                    <input class="form-control" type="password" v-model="form.password">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group ">
                    <label class="form-control-label font-weight-bold">Role </label>
                    <select class="form-control" v-model="form.role">
                        <option value="">Select</option>
                        <option value="admin"  v-if="$localStorage.getItem('role')=='admin'">Admin</option>
                        <option value="agent" v-if="$localStorage.getItem('role')=='admin' || $localStorage.getItem('role')=='agent'">Agent</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn-fill-lmd text-light gradient-dodger-blue btn-block">Save Changes
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
</template>
<script>
export default {
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null,
                role: 'user',
            },
        }
    },
    methods: {
        async onSubmit() {
           this.form.parent_id =  localStorage.getItem('userid');
            var res = await this.callApi('post', `/api/register`, this.form);
            Notification.customSuccess(`Your data has been Updated`);
            this.$router.push({name:'Userslist',params:{status:'active'}})
        }
    },
}
</script>
