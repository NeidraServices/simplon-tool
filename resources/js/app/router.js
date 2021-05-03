import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './views/Home.vue';
import { EvalRoutes } from './views/Evaluation360/router.js';
import { DeliverRoutes } from './views/Deliver/router.js';
import { MarkedownRoutes } from './views/Markedown/router.js';

Vue.use(VueRouter);
var routes = [];
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