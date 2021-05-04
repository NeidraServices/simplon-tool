import Vue from 'vue';
import VueRouter from 'vue-router';
import { EvalRoutes } from './views/Evaluation360/router.js';
import { DeliverRoutes } from './views/Deliver/router.js';
import { MarkedownRoutes } from './views/Markedown/router.js';
import HomePage from './views/Home.vue'
Vue.use(VueRouter);
var routes = [  {
    path: '/',
    name: 'home',
    component: HomePage
},];
routes = routes.concat(EvalRoutes, DeliverRoutes, MarkedownRoutes);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

// router.beforeEach((to, from, next) => {
//     const { requiresAuth } = to.meta;
//     if (requiresAuth) {
//         if (!Store.state.isLogged) {
//             return next({ path: "/" });
//         } else {
//             return next();
//         }
//     }
//     next();
// });

export default router;