<template>
<div>

    <form action="/logout" name="logout" method="post">

    </form>

</div>
</template>

<script>
import axios from 'axios';

export default {

	created(){
        User.loggedOut();
        Notification.customSuccess('Logout successfully Complete');
axios.post('/logout').then(()=>{
    window.location.href = '/'
})
	}
}
</script>

<style lang="css" scoped>
</style>
