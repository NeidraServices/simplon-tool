import Vue            from 'vue';
import VueRouter      from 'vue-router';
import Home           from './views/Home.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
    ]
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