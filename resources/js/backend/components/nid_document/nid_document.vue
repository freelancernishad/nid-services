<template>
    <div>
        <loader v-if="preLooding" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40"
            objectbg="#999793" opacity="80" name="circular"></loader>

        <div class="breadcrumbs-area">
            <h3>Nid Search</h3>
            <ul>
                <li>
                    <router-link :to="{name:'Dashboard'}">Home</router-link>
                </li>
                <li>Nid Search</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="text-right">NID BALANCE : {{ nidbalance }}</div>
                    <form @submit.stop.prevent="onSubmit" class="form">
                        <div class="form-group">
                            <label for="">Nid No</label>
                            <input type="tel" class="form-control" v-model="form.nidno">
                        </div>
                        <div class="form-group">
                            <label for="">Date of birth</label>
                            <input type="date" class="form-control" v-model="form.dob">
                        </div>
                        <div class="text-center">
                            <button class="btn-fill-lmd text-light gradient-dodger-blue btn-block">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="card" v-if="infoId">
            <div class="card-body">

                <table width="100%">

                    <tr>
                        <td colspan="3"> <div class="nidInfoHead"> জাতীয় পরিচিতি বিবরন</div> </td>
                    </tr>


                    <tr>
                        <td></td>
                        <td> <div class="nidInfoImage"> <img :src="nidinformations.photoUrl" alt=""></div> </td>
                        <td></td>
                    </tr>
                </table>

                <table width="100%" class="nidInformation">



                    <tr>
                        <td width="20%">নাম</td>
                        <td width="6%">: </td>
                        <td width="74%">{{ nidinformations.fullNameBN }}</td>
                    </tr>


                    <tr>
                        <td>Name</td>
                        <td>: </td>
                        <td>{{ nidinformations.fullNameEN }}</td>
                    </tr>



                    <tr>
                        <td>পিতা</td>
                        <td>: </td>
                        <td>{{ nidinformations.fathersNameBN }}</td>
                    </tr>


                    <tr>
                        <td>মাতা</td>
                        <td>: </td>
                        <td>{{ nidinformations.mothersNameBN }}</td>
                    </tr>

                    <tr>
                        <td>Date of Birth</td>
                        <td>: </td>
                        <td>{{ nidinformations.dateOfBirth }}</td>
                    </tr>

                    <tr>
                        <td>NID No.</td>
                        <td>: </td>
                        <td>{{ nidinformations.nationalIdNumber }}</td>
                    </tr>

                    <tr>
                        <td>Blood Group</td>
                        <td>: </td>
                        <td>-</td>
                    </tr>

                    <tr class="nidAddress">
                        <td>বর্তমান ঠিকানা</td>
                        <td>: </td>
                        <td> <div class="nAddress"> {{ nidinformations.presentAddressBN }}</div></td>
                    </tr>



                </table>

                <div class="text-center">
                    <a :href="'/download/nid/'+infoId" target="_blank" class="btn btn-info py-3 px-5">Download</a>
                </div>
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
            nidbalance:0,
            preLooding:false,
            form:{
                nidno:'',
                dob:'',
            },
            formstore:{
                'nidno' :'',
                'dob' :'',
                'name_bn' :'',
                'name_en' :'',
                'father_name' :'',
                'mother_name' :'',
                'old_nid' :'',
                'blood_group' :'',
                'present_address' :'',
                'userid' :'',
                'search_date' :'',
            },
            nidinformations:{},
            infoId:'',
            sToken:'',
        }
    },
  watch: {
        '$route':  {
            handler(newValue, oldValue) {
        },
        deep: true
        }
    },
    methods: {

       async onSubmit(){
            this.preLooding = true


            if(this.nidbalance<1){
                Swal.fire({
                            title: 'দুঃখিত',
                            text: `জাতীয় পরিচয়পত্র যাচাই এর ব্যালান্স নেই`,
                            icon: 'error',
                        })
                return;
            }


                    if(this.form.nidno=='' && this.form.dob==''){
                        Swal.fire({
                            title: 'দুঃখিত',
                            text: `জাতীয় পরিচয়পত্র নং এবং জন্ম তারিখ পূরণ করতে হবে`,
                            icon: 'error',
                        })
                        this.preLooding = false;
                    }else{
                        if(this.form.nidno.length==10 || this.form.nidno.length==13 || this.form.nidno.length==17){
                            var nidData = {
                                'nidNumber':this.form.nidno,
                                'dateOfBirth':this.form.dob
                            }
                            var res = await this.callApi('post',`https://uniontax.xyz/api/citizen/information/nid?sToken=${this.sToken}`,nidData);
                            if(res.data.status==200 || res.data.status==301){

                                this.nidbalance--;
                                // this.$emit('check_nid_balace',this.form.unioun_name)

                                this.updateUserBalace(this.nidbalance);


                                var nidD = res.data.informations;
                                this.form.image = nidD.photoUrl
                                this.nidinformations= nidD


                                this.formstore = {
                                    'nidno' :nidD.nationalIdNumber,
                                    'dob' :nidD.dateOfBirth,
                                    'name_bn' :nidD.fullNameBN,
                                    'name_en' :nidD.fullNameEN,
                                    'father_name' :nidD.fathersNameBN,
                                    'mother_name' :nidD.mothersNameBN,
                                    'old_nid' :nidD.oldNationalIdNumber,
                                    'blood_group' :'-',
                                    'present_address' :nidD.permanentAddressBN,
                                    'userid' :1,
                                    'photo' :nidD.photoUrl,
                                }


                                var response = await this.callApi('post',`/api/nidsearched`,this.formstore);

                                this.infoId = response.data.id;





                            }else{

                                Swal.fire({
                                    title: 'দুঃখিত',
                                    text: `কিছু একটা সমস্যা হয়েছে `,
                                    icon: 'error',
                                    confirmButtonColor: 'red',
                                    confirmButtonText: `আবার চেষ্টা করুন`,
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                }).then(async (result) => {
                                    if (result.isConfirmed) {
                                        this.getToken();
                                    }
                                })

                            }
                        this.preLooding = false;
                        }else{
                            Swal.fire({
                                title: 'দুঃখিত',
                                text: `জাতীয় পরিচয়পত্র নং অবশ্যই ১০ অথবা ১৩ অথবা ১৭ ডিজিটের হতে হবে`,
                                icon: 'error',
                            })
                            this.preLooding = false;
                        }
                    }
                    this.getToken();
            this.preLooding = false
        },
        async getToken(){
            var res = await this.callApi('get',`https://uniontax.xyz/api/token/genarate`,[]);
            this.sToken = res.data.apitoken;
            this.preLooding = false;
        },

        async getUser(){
            var res = await this.callApi('get',`/api/admin/user/${localStorage.getItem('userid')}`,[]);
            console.log(res.data.nidbalance);
            this.nidbalance = res.data.nidbalance;
            this.preLooding = false;
        },
        async updateUserBalace(nidb){

            var res = await this.callApi('post',`/api/user/up/${localStorage.getItem('userid')}/${nidb}`,[]);
            this.nidbalance = res.data.nidbalance;
            this.preLooding = false;
        },


    },
    mounted() {
        this.getUser();
        this.getToken();
    }


}
</script>

<style scoped>
.nidInfoHead {
    font-size: 25px;
    font-weight: 600;
    border: 2px solid black;
    padding: 18px 18px 22px 18px;
    border-radius: 22px;
    color: black;
    width: 340px;
    margin: 0 auto;
    text-align: center;
}
.nidInfoImage {
    font-size: 25px;
    font-weight: 600;
    padding: 18px 18px 22px 18px;
    border-radius: 22px;
    color: black;
    width: 215px;
    margin: 0 auto;
    text-align: center;
}

table.nidInformation tr td {
    font-size: 20px;
    font-weight: 600;
    color: black;
}
.nAddress {
    font-size: 15px;
    width: 300px;
}
</style>
