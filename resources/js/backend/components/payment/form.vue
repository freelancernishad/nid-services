<template>


<div>

    <preloader  v-if="preLooding"/>

<Breadcrumbs brename="Payment List"/>



<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">ব্যালেন্স লোড করার নিয়ম</h3>

            <p>প্রথম ধাপঃ Amount এর ঘরে রিচার্জকৃত টাকার পরিমাণ উল্লেখ করতে হবে  (কমপক্ষে ৫০০/- টাকা হতে হবে)।</p>
            <p>দ্বিতীয় ধাপঃ Method অপশন হতে আপনি যে মাধ্যমে টাকা দিতে ইচ্ছুক সেটি Select করুন (যেমন: bKash)।</p>
            <p>তৃতীয় ধাপঃ Payment Wallet ঘরে আপনি যে মোবাইল নং হতে টাকা প্রদান করতে চান সেই নম্বরটি সঠিকভাবে পূরণ করুন (যেমন: ০১৭১২৩৪৫৬৭৮)।</p>
            <p>চতুর্থ ধাপঃ এই ধাপে আপনি আপনার উল্লেখকৃত মোবাইল নং (যা আপনি Payment Wallet Number এ পূরণ করেছেন) হতে Send Money (রিচার্জকৃত টাকা) অপশন হতে এই দুটি নম্বরের (01917-167030 (bKash/Nagad/Rocket) অথবা 01909756552(bKash/Nagad/Rocket) ) যে কোন একটিতে প্রদান করে Trx/Transaction no. সংরক্ষণ করুন এবং Trx/Transaction Id ঘরে এটি সঠিকভাবে প্রদান করুন।</p>
            <p>পঞ্চম ধাপঃ এই ধাপে Admin আপনার Payment-টি verify করে ব্যালেন্স প্রদান সম্পন্ন করবে।</p>
            <p>** যে কোন ধরনের পরামর্শ / সমস্যার কথা জানাতে ইমেইল করুন সাপোর্ট এ মেইল করুন (amardeshservice@gmail.com)</p>



            <form @submit.stop.prevent="onSubmit">
        <div class="row">

            <div class="col-md-12">
                <div class="form-group ">
                    <label class="form-control-label font-weight-bold">Amount <span class="text-danger">*</span></label>
                    <input class="form-control" type="number" min="500" v-model="form.amount" required>
                </div>
            </div>



            <div class="col-md-12">
                <div class="form-group ">
                    <label class="form-control-label font-weight-bold">Method <span class="text-danger">*</span></label>
                    <select class="form-control" v-model="form.method" required>
                        <option value="bKash">bKash</option>
                        <option value="Nagad">Nagad</option>
                        <option value="Rocket">Rocket</option>
                    </select>
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group ">
                    <label class="form-control-label font-weight-bold">Wallet Number <span class="text-danger">*</span></label>
                    <input class="form-control" type="tel"  maxlength="11" minlength="11" v-model="form.payment_wallet"  required >
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group ">
                    <label class="form-control-label font-weight-bold">Transition Id<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" v-model="form.mer_trxid" required>
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

            Notification.customSuccess(`Your data has been Updated`);
            this.$router.push({name:'paymentl'})
            this.preLooding = false;
        }
    },
}
</script>
