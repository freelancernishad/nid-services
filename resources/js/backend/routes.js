let adminlayout = require('./components/layouts/adminlayout.vue').default;
let blanklayout = require('./components/layouts/blanklayout.vue').default;



// Auth Components

let logout = require('./components/auth/logout.vue').default;

let home = require('./components/home.vue').default;
let nid_document = require('./components/nid_document/nid_document.vue').default;
let nid_document_list = require('./components/nid_document/nid_document_list.vue').default;
let notificatoins = require('./components/notifications/list.vue').default;


let Userslist = require('./components/users/list.vue').default;
let UsersView = require('./components/users/view.vue').default;
let Usersform = require('./components/users/form.vue').default;


let Paymentlist = require('./components/payment/list.vue').default;
let PaymentView = require('./components/payment/view.vue').default;
let Paymentform = require('./components/payment/form.vue').default;




let Tags = require('./components/Tags/index.vue').default;
let role = require('./components/assignRole.vue').default;

let index = require('./components/vuex/index.vue').default;


//blogs
let featured_post = require('./components/blogs/featured_post.vue').default;
let blogs = require('./components/blogs/list.vue').default;
let blogform = require('./components/blogs/form.vue').default;
//category
let category = require('./components/blogs/category/list.vue').default;
let categoryform = require('./components/blogs/category/form.vue').default;




let PageNotFound = require('./components/404.vue').default;


let prefix = '/dashboard'
export const routes = [

  //Auth Routes

  { path: `${prefix}/logout`, component: logout, name:'logout',meta: { layout: blanklayout } },

  { path:  `${prefix}`, component: home, name:'Dashboard',meta: { layout: adminlayout } },
  { path:  `${prefix}/n/list`, component: nid_document_list, name:'nid_document_list',meta: { layout: adminlayout } },
  { path:  `${prefix}/n/search`, component: nid_document, name:'nid_document',meta: { layout: adminlayout } },
  { path:  `${prefix}/notificatoins`, component: notificatoins, name:'notificatoins',meta: { layout: adminlayout } },



  { path:  `${prefix}/paymentlist`, component: Paymentlist, name:'paymentl',meta: { layout: adminlayout } },
  { path:  `${prefix}/paymentlist/view/:id`, component: PaymentView, name:'paymentv',meta: { layout: adminlayout } },
  { path:  `${prefix}/paymentlist/addbalace`, component: Paymentform, name:'paymentf',meta: { layout: adminlayout } },
  { path:  `${prefix}/paymentlist/form/:id`, component: Paymentform, name:'paymente',meta: { layout: adminlayout } },



  { path:  `${prefix}/userlist/:status`, component: Userslist, name:'Userslist',meta: { layout: adminlayout } },
  { path:  `${prefix}/userlist/view/:id`, component: UsersView, name:'UsersView',meta: { layout: adminlayout } },
  { path:  `${prefix}/user/form`, component: Usersform, name:'Usersform',meta: { layout: adminlayout } },



  { path:  `${prefix}/tags`, component: Tags, name:'tags',meta: { layout: adminlayout } },
  { path:  `${prefix}/role`, component: role, name:'role',meta: { layout: adminlayout } },

  { path:  `${prefix}/index`, component: index, name:'index',meta: { layout: adminlayout } },

//blogs
{ path:  `${prefix}/featured_post`, component: featured_post, name:'featured_post',meta: { layout: adminlayout } },
{ path:  `${prefix}/blogs`, component: blogs, name:'blogs',meta: { layout: adminlayout } },
{ path:  `${prefix}/blogs/add`, component: blogform, name:'blogform',meta: { layout: adminlayout } },
{ path:  `${prefix}/blogs/edit/:id`, component: blogform, name:'blogedit',meta: { layout: adminlayout } },

//category
{ path:  `${prefix}/category`, component: category, name:'category',meta: { layout: adminlayout } },
{ path:  `${prefix}/category/add`, component: categoryform, name:'categoryform',meta: { layout: adminlayout } },
{ path:  `${prefix}/category/edit/:id`, component: categoryform, name:'categoryedit',meta: { layout: adminlayout } },


  { path: "*", component: PageNotFound }

]
