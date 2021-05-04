import Home from './Home.vue';
import Dashboard from './Dashboard/Dashboard.vue';
import SeeMore from './Dashboard/SeeMore/SeeMore.vue';
import Cohorte from './Formateur/Cohorte.vue';

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
    {
        path: '/evaluation360/Cohorte',
        name: 'Cohorte',
        component: Cohorte
    },
]