import Home from './Home.vue';
import Dashboard from './Dashboard/Dashboard.vue';

export const EvalRoutes = [
    {
        path: '/eval',
        name: 'eval',
        component: Home
    },
    {
        path: '/Dashboard',
        name: 'Dashboard',
        component: Dashboard
    },
]