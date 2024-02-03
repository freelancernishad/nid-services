<template>

<nav aria-label="Page navigation example" style="    background: transparent !important;" v-if="TotalRows>20">
            <ul class="pagination  justify-content-end">
                <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
                <li class="page-item" v-for="(pag,index) in TotalPage" :key="'p'+index" v-if="index==0 && pag.url">
                    <router-link class="page-link"
                        :to="{name:RouteName,RouteParams,query:{page:pag.url.split('?')[1].split('=')[1]}}"
                        v-html="pag.label"></router-link>
                </li>
                <li class="page-item" v-for="(pag,index) in TotalPage" :key="'i'+index"
                    :class="{active:pag.active,'disabled':pag.label=='...'}"
                    v-if="index!=0 && pag.label!='Next &raquo;'">
                    <router-link class="page-link"
                        :to="{name:RouteName,RouteParams,query:{page:pag.label}}"
                        v-html="pag.label"></router-link>
                </li>
                <li class="page-item" v-for="(pag,index) in TotalPage" :key="'l'+index"
                    v-if="pag.label=='Next &raquo;'  && pag.url">
                    <router-link class="page-link"
                        :to="{name:RouteName,RouteParams,query:{page:pag.url.split('?')[1].split('=')[1]}}"
                        v-html="pag.label"></router-link>
                </li>
                <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
            </ul>
        </nav>
</template>
<script>
export default {
    props: {
        TotalRows: {
            type: String,
            default: '20'
        },
        RouteName: {
            type: String,
            default: 'notice'
        },
        RouteParams: {
            type: Object,
            default: {}
        },
        TotalPage: {
            type: Array,
            default: []
        },
    }
}
</script>
