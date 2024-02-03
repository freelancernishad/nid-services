<template>


<div>

    <preloader  v-if="preLooding"/>

<Breadcrumbs brename="Payment List"/>



<div class="container">
    <div class="card">
        <div class="card-body">

            <form @submit.stop.prevent="onSubmit">
        <div class="row">

            <div class="col-md-12">
                <div class="form-group ">
                    <label class="form-control-label font-weight-bold">Amount <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" v-model="form.amount" value="sa">
                </div>
            </div>



            <div class="col-md-12">
                <div class="form-group ">
                    <label class="form-control-label font-weight-bold">Method </label>
                    <select class="form-control" v-model="form.method">
                        <option value="bKash">bKash</option>
                        <option value="Nagad">Nagad</option>
                        <option value="Rocket">Rocket</option>
                    </select>
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group ">
                    <label class="form-control-label font-weight-bold">Payment Wallet <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" v-model="form.payment_wallet" value="sa">
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group ">
                    <label class="form-control-label font-weight-bold">Transition Id<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" v-model="form.mer_trxid" value="sa">
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn-fill-lmd text-light gradient-dodger-blue btn-block">Make Payment
                    </button>
                </div>
            </div>
        </div>
    </form>
        </div>
    </div>
</div>

</div>
</template>
<script>
export default {
    data() {
        return {
            preLooding:false,
            form: {
                userid: null,
                amount: null,
                payment_wallet: null,
                method: null,
                mer_trxid: null,
            },
        }
    },
    methods: {
        async onSubmit() {
            this.preLooding = true;
            this.form.userid = localStorage.getItem('userid');
            var res = await this.callApi('post', `/api/payments`, this.form);
            console.log(res);
            Notification.customSuccess(`Your data has been Updated`);
            this.preLooding = false;
        }
    },
}
</script>
