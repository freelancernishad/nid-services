<template>
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
                    <label class="form-control-label font-weight-bold">Status </label>
                    <select class="form-control" v-model="form.status">
                        <option value="active">Active</option>
                        <option value="banned">Banned</option>
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
</template>
<script>
export default {
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null,
                status: null,
            },
        }
    },
    methods: {
        async onSubmit() {
            var id = this.$route.params.id;
            var res = await this.callApi('put', `/api/admin/user/${id}`, this.form);
            Notification.customSuccess(`Your data has been Updated`);
            this.getData();
        }
    },
}
</script>
