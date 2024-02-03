<template>
                <nav aria-label="Page navigation example" v-if="Totalrowsprops>Paginaterowsprops">
            <ul class="pagination  justify-content-end">
                <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
                <li class="page-item" v-for="(pag,index) in Totalpageprops" :key="'p'+index" v-if="index==0 && pag.url">
                    <router-link class="page-link" :to="{name:Routenameprops,params:Routeparamsprops,query:{page:pag.url.split('?')[1].split('=')[1]}}" v-html="pag.label"></router-link>
                </li>
                <li class="page-item" v-for="(pag,index) in Totalpageprops" :key="'i'+index" :class="{active:pag.active,'disabled':pag.label=='...'}"  v-if="index!=0 && pag.label!='Next &raquo;'">
                    <router-link class="page-link" :to="{name:Routenameprops,params:Routeparamsprops,query:{page:pag.label}}" v-html="pag.label"></router-link>
                </li>
                <li class="page-item" v-for="(pag,index) in Totalpageprops" :key="'l'+index" v-if="pag.label=='Next &raquo;'  && pag.url">
                    <router-link class="page-link" :to="{name:Routenameprops,params:Routeparamsprops,query:{page:pag.url.split('?')[1].split('=')[1]}}" v-html="pag.label"></router-link>
                </li>
                <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
            </ul>
        </nav>
</template>
<script>
export default {
    props: {
        Paginaterowsprops: {
            type: Number,
            dmeefault: 20
        },
        Totalrowsprops: {
            type: Number,
            dmeefault: 0
        },
        Totalpageprops: {
            type: Array,
            dmeefault: []
        },
        Routenameprops: {
            type: String,
            dmeefault: ''
        },
        Routeparamsprops: {
            type: Object,
            dmeefault: {}
        }

    },
}
</script>
