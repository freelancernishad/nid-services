<template>


   <div class="login-page">
      <div class="wallpaper-register"></div>

      <div class="container">
         <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-8 mx-auto">
               <div class="card login" v-bind:class="{ error: emptyFields }">
               <div class="card-body">
                  <h1>Sign In</h1>
                  <form class="form-group" @submit.prevent='login'>
                     <input v-model="form.email" type="email" class="form-control" placeholder="Email" required>
                     <input v-model="form.password" type="password" class="form-control" placeholder="Password" required>
                     <input type="submit" class="btn btn-primary" >

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

	created(){
		if (User.loggedIn()) {
			window.location.href = '/dashboard'
		}
	},

	data () {
		return {

            emailLogin: "",
            passwordLogin: "",
            emailReg: "",
            passwordReg: "",
            confirmReg: "",
            emptyFields: false,
			form: {
				email: '',
				password: ''
			},
			errors:{}
		}
	},
	methods:{
		login(){

         if (this.form.email == "" || this.form.password == "") {
            this.emptyFields = true;
         } else {

       		axios.post('/login', this.form)
			.then(res => {
				User.responseAfterLogin(res)
                Notification.customSuccess('Signed in successfully Complete');
				// this.$router.push({name: 'home'})
              	window.location.href = '/dashboard'
			})
			.catch(error => this.errors = error.response.data.errors)



         }





		}
	}
}
</script>

<style lang="css" scoped>
p {
  line-height: 1rem;
}



.form-group input {
  margin-bottom: 20px;
}

.login-page {
  align-items: center;
  display: flex;
  height: 100vh;
}
.login-page .wallpaper-register[data-v-2a1c1b9c] {
    background: linear-gradient(45deg, black, #00000047),url(https://images.pexels.com/photos/533671/pexels-photo-533671.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260) no-repeat center center;
    background-size: cover;
    height: 100%;
    position: absolute;
    width: 100%;
    z-index: -1;
}
.login-page .fade-enter-active,
.login-page .fade-leave-active {
  transition: opacity 0.5s;
}
.login-page .fade-enter,
.login-page .fade-leave-to {
  opacity: 0;
}
.login-page .wallpaper-register {
  background: url(https://images.pexels.com/photos/533671/pexels-photo-533671.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260) no-repeat center center;
  background-size: cover;
  height: 100%;
  position: absolute;
  width: 100%;
  z-index: -1;
}
.login-page h1 {
  margin-bottom: 1.5rem;
}

.error {
  animation-name: errorShake;
  animation-duration: 0.3s;
}

@keyframes errorShake {
  0% {
    transform: translateX(-25px);
  }
  25% {
    transform: translateX(25px);
  }
  50% {
    transform: translateX(-25px);
  }
  75% {
    transform: translateX(25px);
  }
  100% {
    transform: translateX(0);
  }
}

</style>

