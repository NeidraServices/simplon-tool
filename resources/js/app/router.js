import Vue from 'vue';
import VueRouter from 'vue-router';
import { EvalRoutes } from './views/Evaluation360/router.js';
import { DeliverRoutes } from './views/Deliver/router.js';
import { MarkedownRoutes } from './views/Markedown/router.js';
import HomePage from './views/Home.vue'
import { authenticationService } from "./services/authenticationService";
import { Role } from './helpers/role.js';
import Login from './login/Login.vue';
import Compte from './views/compte/Compte.vue';
import VerifyMail from './views/VerifyMail.vue';

Vue.use(VueRouter);

var routes = [
    {
        path: '/',
        name: 'home',
        component: HomePage,
        meta: { authorize: Role }
    },
    {
        path: '/connexion',
        name: 'login',
        component: Login,
    },
    {
        path: '/compte/:id',
        name: 'compte',
        component: Compte,
    },
    {
        path: '/email/verification/:token',
        name: 'verification',
        component: VerifyMail,
    },
];

routes = routes.concat(EvalRoutes, DeliverRoutes, MarkedownRoutes);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});


router.beforeEach((to, from, next) => {
    const { authorize } = to.meta;
    if (authorize && !_.isEmpty(authorize)) {
        const role = authenticationService.currentRoleValue;

        if (!role) {
            // not logged in so redirect to login page with the return url
            return next({ path: "/connexion", query: { returnUrl: to.path } });
        }

        if (authorize.length && !authorize.includes(role.name)) {
            // role not authorised so redirect to home page
            return next({ path: "/" });
        }
    }
    next();
});

export default router;