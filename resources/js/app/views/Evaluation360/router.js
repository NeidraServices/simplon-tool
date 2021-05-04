import Home from './Home.vue';
import Dashboard from './Dashboard/Dashboard.vue';
import SeeMore from './Dashboard/SeeMore/SeeMore.vue';
export const EvalRoutes = [
    {
        path: '/evaluation360',
        name: 'eval',
        component: Home
    },
    {
        path: '/evaluation360/Dashboard',
        name: 'Dashboard',
        component: Dashboard
    },
    {
        path: '/evaluation360/Details',
        name: 'SeeMore',
        component: SeeMore
    },
]