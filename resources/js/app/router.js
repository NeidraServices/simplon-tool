import Vue from 'vue';
import VueRouter from 'vue-router';
import { EvalRoutes } from './views/Evaluation360/router.js';
import { DeliverRoutes } from './views/Deliver/router.js';
import { MarkedownRoutes } from './views/Markedown/router.js';
import HomePage from './views/Home.vue'
import { authenticationService } from "./services/authenticationService";
import { Role } from './helpers/role.js';
import Login from './login/Login.vue';

Vue.use(VueRouter);
var routes = [{
    path: '/',
    name: 'home',
    component: HomePage
},
{
    path: '/connexion',
    name: 'login',
    component: Login,
},
];
routes = routes.concat(EvalRoutes, DeliverRoutes, MarkedownRoutes);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});


router.beforeEach((to, from, next) => {

    // redirect to login page if not logged in and trying to access a restricted page
    const { authorize } = to.meta;

    if (authorize && !_.isEmpty(authorize)) {

        const currentUser = authenticationService.currentUserValue;

        if (!currentUser) {
            // not logged in so redirect to login page with the return url
            return next({ path: "/login", query: { returnUrl: to.path } });
        }
        // check if route is restricted by role
        if (authorize.length && !authorize.includes(currentUser.role.label)) {
            // role not authorised so redirect to home page
            return next({ path: "/" });
        }

    }

    return next();
});

export default router;