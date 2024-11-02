import Vue from 'vue'
import VueRouter from 'vue-router'
import DefaultLayout from '../layouts/Default.vue'
import Identified from "../layouts/Identified";
import NotChecked from "../layouts/NotChecked";
import Login from '../pages/Login'
import OfferAccept from "../pages/OfferAccept";
import Profile from "../pages/Profile/Profile";
import Register from "../pages/Register";
import Account from "../pages/Account/Account";
import Dashboard from "../pages/Dashboard/Dashboard";
import Task from "../pages/Task/Task";
import Markup from "../pages/Markup/Markup";
import authService from "../services/auth.service";
import offerServices from "../services/offer.service";

Vue.component('Default', DefaultLayout);
Vue.component('NotChecked', NotChecked);
Vue.component('Identified', Identified);
Vue.config.productionTip = false;
Vue.use(VueRouter);

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: {
      auth: false,
      checked: false,
      layout: "Default",
    }
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
    meta: {
      layout: "Default",
      auth: false,
      checked: false
    }
  },
  {
    path: '/useragreement',
    name: 'UserAgreement',
    component: OfferAccept,
    meta: {
      layout: "Default",
      auth: false,
      checked: false
    }
  },
  {
    path:'/profile',
    name: 'Profile',
    component: Profile,
    meta: {
      layout: "NotChecked",
      auth: true,
      checked: false
    }
  },
  {
    path: '/account',
    name: 'Account',
    component: Account,
    meta: {
      layout: "Identified",
      auth: true,
      checked: true
    }
  },
  {
    path: '/',
    name: 'Dashboard',
    component: Dashboard,
    meta: {
      layout: "Identified",
      auth: true,
      checked: true
    }
  },
  {
    path: '/dashboard/:id',
    name: 'Task',
    component: Task,
    props: true,
    meta: {
      layout: "Identified",
      auth: true,
      checked: true
    }
  },
  {
    path: '/markup',
    name: 'Markup',
    component: Markup,
    meta: {
      layout: "Identified",
      auth: true,
      checked: true
    }
  },
  // {
  //   path: '/about',
  //   name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
  //   component: () => import(/* webpackChunkName: "about" */ '../pages/About.vue')
  // }
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
});

router.beforeEach((to, from, next)=>{
  if(to.meta.auth && authService.isLoggedIn()){
    if(offerServices.compareTokens() && to.name !== 'UserAgreement'){
      if(authService.isChecked() && to.name === 'Profile'){
        next({name: 'Account'})
      }
      if(!authService.isChecked() && to.name === 'Account'){
        next({name: 'Profile'})
      }
      next()
    }else{
      next({name: 'UserAgreement'})
    }
  }else{
    if(to.meta.auth && !authService.isLoggedIn()){
      next({name: 'Login'})
    }else{
      next()
    }
  }
});


// router.beforeEach((to, from, next) =>{
//   if(authService.isLoggedIn() && to.meta.auth){
//     personalService.getStatus();
//     if(!offerServices.compareTokens() && to.name !== 'UserAgreement'){
//       next({name: 'UserAgreement'})
//     }else{
//       if(!to.meta.checked){
//         next()
//       }else{
//         if(authService.isChecked()){
//           next()
//         }
//       }
//     }
//   }else{
//     next();
//   }
// });

// router.beforeEach((to, from, next) => {
//   if (to.meta.auth && !authService.isLoggedIn()) {
//     next({name: 'Login'})
//   } else {
//     if(to.meta.auth && offerServices.compareOfferTokens()){
//       if(to.meta.checked && authService.isChecked() || to.name === 'Profile'){
//         next();
//       }else {
//         next({name: 'Profile'})
//       }
//     }else{
//       next();
//     }
//   }
// });

export default router
