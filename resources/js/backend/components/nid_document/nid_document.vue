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
                    <a :href="'/dashboard/download/nid/'+infoId" target="_blank" class="btn btn-info py-3 px-5">Download</a>


                    <button class="btn btn-info py-3 px-5" @click="openModal">Full File Download</button>
<!--
                    <a :href="'/dashboard/download/nid/'+infoId+'?type=full'" target="_blank" class="btn btn-info py-3 px-5">Full File Download</a> -->



                </div>
            </div>
        </div>


    <!-- Modal -->
    <div class="modal2" :class="{ 'open': showModal }">
      <div class="modal2-content">
        <span class="close" @click="closeModal">&times;</span>
        <p>This is a modal!</p>



        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form @submit.stop.prevent="updatefile" class="form">


                        <div class="form-group">
                            <label for="">Blood Group</label>
                            <select class="form-control" v-model="formstore.blood_group">
                                <option>Select</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                            <!-- <input type="text" class="form-control" v-model="formstore.blood_group"> -->
                        </div>


                        <div class="form-group">
                            <label for="">Identification</label>
                            <input type="text" class="form-control" v-model="formstore.identification">
                        </div>


                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="tel"  maxlength="11" minlength="11" class="form-control" v-model="formstore.phone">
                        </div>


                        <div class="form-group">
                            <label for="">Mobile</label>
                            <input type="text" class="form-control" v-model="formstore.mobile">
                        </div>

                        <div class="form-group">
                            <label for="">Religion</label>
                            <select class="form-control" v-model="formstore.religion">
                                <option>Select</option>
                                <option>Islam</option>
                                <option>Hinduism</option>
                                <option>Christianity</option>
                                <option>Buddhism</option>
                            </select>
                            <!-- <input type="text" class="form-control" v-model="formstore.religion"> -->
                        </div>

                        <div class="form-group d-none">
                            <label for="">No Finger</label>
                            <input type="text" class="form-control" v-model="formstore.no_finger">
                        </div>

                        <div class="form-group d-none">
                            <label for="">No Finger Print</label>
                            <input type="text" class="form-control" v-model="formstore.no_finger_print">
                        </div>

                        <div class="text-center">
                            <button class="btn-fill-lmd text-light gradient-dodger-blue btn-block">Download</button>
                        </div>
                    </form>
                </div>
            </div>
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
            showModal: false,
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
                'permanent_address' :'',
                'userid' :'',
                'search_date' :'',


                'oldNationalIdNumber' :'',
                'spouseNameBN' :'',
                'gender' :'',
                'profession' :'',
                'disability' :'',
                'Disability_other' :'',
                'presentDivision' :'',
                'presentDistrict' :'',
                'present_rmo' :'',
                'present_city' :'',
                'presentThana' :'',
                'presentUnion' :'',
                'present_mouza' :'',
                'present_additional_mouza' :'',
                'presentPost' :'',
                'presentPostCode' :'',
                'present_region' :'',

                'permanentDivision' :'',
                'permanentDistrict' :'',
                'permanent_rmo' :'',
                'permanent_city' :'',
                'permanentThana' :'',
                'permanentUnion' :'',
                'permanent_mouza' :'',
                'permanent_additional_mouza' :'',
                'permanentPost' :'',
                'permanentPostCode' :'',
                'permanent_region' :'',

                'identification' :'',
                'phone' :'',
                'mobile' :'',
                'religion' :'',
                'no_finger' :'0',
                'no_finger_print' :'0',
            },
            nidinformations:{},
            infoId:'',
            sToken:'',
            id:'',
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

        openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
        async updatefile(){
            this.preLooding = true
            var res = await this.callApi('post',`/api/update/nid/data/${this.id}`,this.formstore);
            if(res.status==200){
                window.open(`/dashboard/download/nid/${this.infoId}?type=full`, '_blank');
                // window.location.href = `/dashboard/download/nid/${this.infoId}?type=full`;
            }else{
                Swal.fire({
                    title: 'দুঃখিত',
                    text: `আবার চেষ্টা করুন`,
                    icon: 'error',
                })
            }

            this.preLooding = false
        },

       async onSubmit(){
            this.preLooding = true


            if(this.nidbalance<1){
                Swal.fire({
                            title: 'দুঃখিত',
                            text: `জাতীয় পরিচয়পত্র যাচাই এর ব্যালান্স নেই`,
                            icon: 'error',
                        })
                        this.preLooding = false;
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

                                console.log(nidD);
                                this.formstore = {
                                    'nidno' :nidD.nationalIdNumber,
                                    'dob' :nidD.dateOfBirth,
                                    'name_bn' :nidD.fullNameBN,
                                    'name_en' :nidD.fullNameEN,
                                    'father_name' :nidD.fathersNameBN,
                                    'mother_name' :nidD.mothersNameBN,
                                    'old_nid' :nidD.oldNationalIdNumber,
                                    'blood_group' :'-',
                                    'present_address' :nidD.presentAddressBN,
                                    'permanent_address' :nidD.permanentAddressBN,
                                    'userid' :localStorage.getItem('userid'),
                                    'photo' :nidD.photoUrl,


                                    'oldNationalIdNumber' :nidD.oldNationalIdNumber,
                                    'spouseNameBN' :nidD.spouseNameBN,
                                    'gender' :nidD.gender,
                                    'profession' :nidD.profession,
                                    'disability' :'',
                                    'Disability_other' :'',
                                    'presentDivision' :'',
                                    'presentDistrict' :nidD.presentDistrict,
                                    'present_rmo' :'',
                                    'present_city' :'',
                                    'presentThana' :nidD.presentThana,
                                    'presentUnion' :nidD.presentUnion,
                                    'present_mouza' :'',
                                    'present_additional_mouza' :'',
                                    'presentPost' :nidD.presentPost,
                                    'presentPostCode' :nidD.presentPostCode,
                                    'present_region' :'',

                                    'permanentDivision' :'',
                                    'permanentDistrict' :nidD.permanentDistrict,
                                    'permanent_rmo' :'',
                                    'permanent_city' :'',
                                    'permanentThana' :nidD.permanentThana,
                                    'permanentUnion' :nidD.permanentUnion,
                                    'permanent_mouza' :'',
                                    'permanent_additional_mouza' :'',
                                    'permanentPost' :nidD.permanentPost,
                                    'permanentPostCode' :nidD.permanentPostCode,
                                    'permanent_region' :'',

                                    'identification' :'',
                                    'phone' :'',
                                    'mobile' :'',
                                    'religion' :'',
                                    'no_finger' :'',
                                    'no_finger_print' :'',



                                }

                                console.log(this.formstore);

                                var response = await this.callApi('post',`/api/nidsearched`,this.formstore);

                                this.infoId = response.data.token;
                                this.id = response.data.id;





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
            var res = await this.callApi('get',`/api/single/user/${localStorage.getItem('usertoken')}`,[]);
            console.log(res.data.nidbalance);
            this.nidbalance = res.data.nidbalance;
            this.preLooding = false;
        },
        async updateUserBalace(nidb){

            var res = await this.callApi('post',`/api/user/up/${localStorage.getItem('usertoken')}/${nidb}`,[]);
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

.modal2 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1000; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
}

.modal2.open {
  display: block; /* Hidden by default */

}

/* Modal content */
.modal2-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Close button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}



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
