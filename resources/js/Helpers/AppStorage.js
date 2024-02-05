class AppStorage{

	storeToken(token){
		localStorage.setItem('token',token);
	}

	storeUser(user){
		localStorage.setItem('user',user);
	}
	storeUserid(userid){
		localStorage.setItem('userid',userid);
	}

	storeUsertoken(usertoken){
		localStorage.setItem('usertoken',usertoken);
	}

    storerole(role){
		localStorage.setItem('role',role);
	}

	store(token,user,userid,role,usertoken){
		this.storeToken(token)
		this.storeUser(user)
		this.storeUserid(userid)
		this.storeUsertoken(usertoken)
		this.storerole(role)
	}

	clear(){
		localStorage.removeItem('token')
		localStorage.removeItem('user')
		localStorage.removeItem('userid')
		localStorage.removeItem('usertoken')
		localStorage.removeItem('role')
	}

	getToken(){
		localStorage.getItem(token);
	}

	getUser(){
		localStorage.getItem(user);
	}

}

export default AppStorage = new AppStorage();
