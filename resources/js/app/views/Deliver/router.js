import Home from './Home.vue';
import Projet from './Details-projet.vue';
import MesProjets from './mes-projets.vue';

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
    {
        path: '/deliver/mesprojets',
        name: 'mesprojets',
        component: MesProjets
    },
]
