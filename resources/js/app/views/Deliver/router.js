import Home from './Home.vue';
import Projet from './Details-projet.vue';

export const DeliverRoutes = [
    {
        path: '/deliver/projet/:id',
        name: 'testDeliver',
        component: Projet
    },
    {
        path: '/deliver',
        name: 'deliver',
        component: Home
    },
]
