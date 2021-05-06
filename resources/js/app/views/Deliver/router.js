import Home from './Home.vue';
import Projet from './Details-projet.vue';
import MesProjets from './mes-projets.vue';
import Formateur from './Formateur.vue';
import DetailsRendu from './Details-rendu.vue';

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
    {
        path: '/deliver/formateur',
        name: 'formateur',
        component: Formateur
    }
        path: '/deliver/mesprojets/rendu/:id',
        name: 'detailsRendu',
        component: DetailsRendu
    },
]
