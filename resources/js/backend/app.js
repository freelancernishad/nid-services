import Vue from 'vue'
require('../bootstrap');

// import "datatables.net-dt/js/dataTables.dataTables";
// import 'datatables.net-buttons-bs4'
// // import 'datatables.net-buttons'


// Vue.use(moment)
// import { Datetime } from 'vue-datetime';
// import 'vue-datetime/dist/vue-datetime.css'
// Vue.component('datetime', Datetime);







// Vue.use(require('vue-moment'));

// require( 'jszip' );
// require( 'pdfmake' );
// require( 'semantic-ui-button' );
// require( 'datatables.net-autofill-dt' );

// require( 'datatables.net-dt' );
// require( 'datatables.net-buttons-dt' );
// require( 'datatables.net-bs5' );
// require( 'datatables.net-buttons-bs5' );
// require( 'datatables.net-bs4' );
// require( 'datatables.net-buttons-bs4' );

// require( 'datatables.net-buttons/js/buttons.colVis.js' );
// require( 'datatables.net-buttons/js/buttons.html5.js' );
// require( 'datatables.net-buttons/js/buttons.print.js' );

// require( 'datatables.net-buttons/js/buttons.colVis.js' )();
// require( 'datatables.net-buttons/js/buttons.html5.js' )();
// require( 'datatables.net-buttons/js/buttons.print.js' )();


// require( 'datatables.net-colreorder-dt' );
// require( 'datatables.net-datetime' );
// require( 'datatables.net-fixedcolumns-dt' );
// require( 'datatables.net-fixedheader-dt' );
// require( 'datatables.net-keytable-dt' );
// require( 'datatables.net-responsive-dt' );
// require( 'datatables.net-rowgroup-dt' );
// require( 'datatables.net-rowreorder-dt' );
// require( 'datatables.net-scroller-dt' );
// require( 'datatables.net-searchbuilder-dt' );
// require( 'datatables.net-searchpanes-dt' );
// require( 'datatables.net-select-dt' );
// require( 'datatables.net-staterestore-dt' );




import { BButton, BCol, BContainer, BFormGroup, BFormInput, BInputGroup, BInputGroupAppend, BModal, BPagination, BRow, BTable } from 'bootstrap-vue'
Vue.component('b-modal', BModal)
Vue.component('b-button', BButton)
Vue.component('b-table', BTable)
Vue.component('b-container', BContainer)
Vue.component('b-row', BRow)
Vue.component('b-col', BCol)
Vue.component('b-form-group', BFormGroup)
Vue.component('b-input-group', BInputGroup)
Vue.component('b-form-input', BFormInput)
Vue.component('b-input-group-append', BInputGroupAppend)
Vue.component('b-pagination', BPagination)


import 'bootstrap-vue/dist/bootstrap-vue.css'

// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Vue.use(BootstrapVue)
// Vue.use(IconsPlugin)

import Swal from 'sweetalert2'
window.Swal = Swal;

import VueRouter from 'vue-router'
Vue.use(VueRouter)
import {routes} from './routes';

import store from '../store'

import tablecom from '../table.vue'
Vue.component('TableComponent', tablecom);


import Multiselect from 'vue-multiselect'

// register globally
Vue.component('multiselect', Multiselect)


import UserForm from './components/users/form.vue'
Vue.component('UserForm', UserForm);

import UserView from './components/users/view.vue'
Vue.component('UserView', UserView);

import Breadcrumbs from './components/breadcrumbs.vue'
Vue.component('Breadcrumbs', Breadcrumbs)

import Paginate from './components/paginate.vue'
Vue.component('Paginate', Paginate)

import { Bar } from 'vue-chartjs/legacy'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

Vue.component('Bar', Bar);


import VueTimeago from 'vue-timeago'

import loader from "vue-ui-preloader";

Vue.use(loader);



Vue.use(VueTimeago, {
  name: 'Timeago', // Component name, `Timeago` by default
  locale: 'en', // Default locale
  // We use `date-fns` under the hood
  // So you can use all locales from it
  locales: {
    'zh-CN': require('date-fns/locale/zh_cn'),
    ja: require('date-fns/locale/ja')
  }
})




window.Reload = new Vue();
const router = new VueRouter({
  routes,
  mode: 'history'
})
const app = new Vue({
    el: '#app',
    router,
    store
});


