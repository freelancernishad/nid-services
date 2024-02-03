<template>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col-md-12 col-lg-12 col-xl-12 offset-xl-1">
                    <form @submit.prevent="login" class="loginForm">
                        <div class="form">
                            <h1 class="text-center mb-5">লগইন</h1>
                            <div class="form-item" id="inputEmail">
                                <input type="text" id="email" v-model="form.email" @blur="blur('email')"
                                    @input="blur('email')" autocomplete="on" required />
                                <label for="Email">ইমেইল</label>
                            </div>

                            <div class="form-item">
                                <input type="password" id="password" v-model="form.password" @blur="blur('password')"
                                    @input="blur('password')" autocomplete="off" required />
                                <label for="password">পাসওয়ার্ড</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" v-model="rememberme"
                                    id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    মনে রাখুন
                                </label>
                            </div>

                            <a class="btn btn-link" href="/password/reset">পাসওয়ার্ড ভুলে গেছেন?</a>


                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" v-if="!loadLogin"
                                style="padding-left: 2.5rem; padding-right: 2.5rem">
                                লগইন করুন
                            </button>

                            <span class="btn btn-primary btn-lg" v-else
                                style="padding-left: 2.5rem; padding-right: 2.5rem">Looding.....</span>
                        </div>




                    </form>




                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    created() {
        if (User.loggedIn()) {

            if(this.$route.query.redirect){
                window.location.href = this.$route.query.redirect;
            }else{

                window.location.href = "/dashboard";
            }
            // window.location.href = "/dashboard";
        }
        if (localStorage.getItem("login")) {
            this.form = JSON.parse(localStorage.getItem("login"));
            this.rememberme = true;
        }
  
    },

    data() {
        return {
            loadLogin: false,
            emailLogin: "",
            passwordLogin: "",
            emailReg: "",
            passwordReg: "",
            confirmReg: "",
            rememberme: false,
            emptyFields: false,
            form: {
                email: "",
                password: "",
            },

            errorss: {},
        };
    },
    methods: {




        async login() {
            this.loadLogin = true;

            if (this.form.email == "" || this.form.password == "") {
                this.emptyFields = true;
            } else {
                if (this.rememberme) {
                    localStorage.setItem("login", JSON.stringify(this.form));
                } else {
                    localStorage.removeItem("login");
                }

                // var res = await this.callApi('post','/login',this.form);
                //    console.log(res)

                //     if(res.status==200){
                //         	User.responseAfterLogin(res)
                //             Notification.customSuccess('Signed in successfully Complete');
                //             this.loadLogin = false
                //           	window.location.href = '/dashboard'
                //     }else{
                //           Notification.customError('Please Enter Valid Email and Password');
                //                this.loadLogin = false
                //     }

                axios
                    .post("/login", this.form)
                    .then((res) => {
                        // console.log(res);

                        if (res.data == 0) {
                            Notification.customError("Please Enter Valid Email and Password");
                            this.loadLogin = false;
                        } else {
                            User.responseAfterLogin(res);
                            Notification.customSuccess("Signed in successfully Complete");
                            this.loadLogin = false;

                            if(this.$route.query.redirect){
                                window.location.href = this.$route.query.redirect;
                            }else{

                                if(res.role=='data_entry_oparetor'){

                                    window.location.href = "/dashboard/only/result";
                                }else if(res.role=='camera_man'){

                                    window.location.href = "/dashboard/student/img";
                                }else{

                                    window.location.href = "/dashboard";
                                }


                            }
                        }


                    })
                    .catch((error) => (this.errorss = error.response.data.errors));
            }
        },

        blur(id) {
            const child = document.getElementById(id);
            if (this.form[id] == "") {
                child.parentNode.classList.remove("blursuccess");
                child.parentNode.classList.add("blurerror");
            } else {
                child.parentNode.classList.remove("blurerror");
                child.parentNode.classList.add("blursuccess");
            }
        },
    },
};
</script>

<style lang="css" scoped>
section.vh-100 {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
}

.blurerror input {
    border: 1px solid red !important;
}

.blurerror label {
    color: red !important;
}

.blursuccess input {
    border: 1px solid green !important;
}

.blursuccess label {
    color: green !important;
}

.divider:after,
.divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
}

*,
*:focus {
    outline: none;
}

/* .form{
  width: 500px;
  margin: 0 auto;
  margin-top: 150px;
  font-family: sans-serif;
  background: #fff
} */
.form-item {
    position: relative;
    margin-bottom: 15px;
}

.form-item input {
    display: block;
    width: 100%;
    height: 40px;
    background: transparent;
    border: solid 1px #ccc;
    transition: all 0.3s ease;
    padding: 0 15px;
}

.form-item input:focus {
    border-color: blue;
}

.form-item label {
    position: absolute;
    cursor: text;
    z-index: 2;
    top: 13px;
    left: 10px;
    font-size: 12px;
    font-weight: bold;
    background: #fff;
    padding: 0 10px;
    color: #999;
    transition: all 0.3s ease;
}

.form-item input:focus+label,
.form-item input:valid+label {
    font-size: 11px;
    top: -5px;
}

.form-item input:focus+label {
    color: blue;
}

.loginForm {
    width: 370px !important;
    margin: 0 auto;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}
.col-md-12.col-lg-12.col-xl-12.offset-xl-1 {
    height: 100vh;
}

</style>

