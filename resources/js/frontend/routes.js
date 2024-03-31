let layout = require('./components/layouts/layout.vue').default;
let blanklayout = require('./components/layouts/blanklayout.vue').default;


let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;



let home = require('./components/home.vue').default;
let about = require('./components/pages/about.vue').default;
let blog = require('./components/pages/blog.vue').default;
let singleblog = require('./components/pages/singleblog.vue').default;
let contact = require('./components/pages/contact.vue').default;
let termsAndCondition = require('./components/pages/termsAndCondition.vue').default;
let PageNotFound = require('./components/404.vue').default;


let prefix = '/'
export const routes = [
    { path:  `${prefix}`, component: home, name:'home',meta: { layout: layout } },
    { path:  `${prefix}about`, component: about, name:'about',meta: { layout: layout } },
    { path:  `${prefix}blog`, component: blog, name:'blog',meta: { layout: layout } },
    { path:  `${prefix}blog/{slug}`, component: singleblog, name:'singleblog',meta: { layout: layout } },
    { path:  `${prefix}contact-us`, component: contact, name:'contact',meta: { layout: layout } },
    { path:  `${prefix}termsAndCondition`, component: termsAndCondition, name:'termsAndCondition',meta: { layout: layout } },
    { path: `${prefix}login`, component: login, name:'/login',meta: { layout: blanklayout } },
    { path:  `${prefix}register`, component: register, name:'register',meta: { layout: blanklayout } },
    { path:  `${prefix}forget`, component: forget, name:'forget',meta: { layout: blanklayout } },



  { path: "*", component: PageNotFound }

]

