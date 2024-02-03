<template>
    <div>


<div class="breadcrumbs-area">
    <h3>Blog form</h3>
    <ul>
        <li>
            <router-link :to="{name:'Dashboard'}">Home</router-link>
        </li>
        <li>Blog form</li>
    </ul>
</div>


    <div class="card">
        <div class="card-body">


                <div class="form-group">
                    <label for="">Featured Posts</label>
                    <multiselect v-model="value" :options="options" label="title" track-by="id" :multiple="true" required></multiselect>
                </div>

                <button class="btn btn-info" @click="setFiPost">Set Featured Post</button>
      
        </div>
    </div>

    </div>
</template>
<script>
export default {
    data (){
        return {

                value: null,

            options: [],
        }
    },
    methods: {
       async getAllPosts(){
        this.options = []
            var res = await this.callApi('get',`/api/get/blog/list?featured_post=1`,[]);
            res.data.forEach(element => {
                // console.log(element)
                this.options.push({ id: element.id, title: element.title });
            });
            // console.log(this.options)
        },


        async setFiPost(){
            var res = await this.callApi('post',`/api/set/featured/post`,this.value);
            console.log(res)
        },

    },
    mounted() {
        this.getAllPosts();
    },
}
</script>
