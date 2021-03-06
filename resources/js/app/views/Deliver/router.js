import Home from './Home.vue';
import DetailProjet from './Details-projet.vue';
import MesProjets from './mes-projets.vue';
import Formateur from './Formateur.vue';
import DetailsRendu from './Details-rendu.vue';

export const DeliverRoutes = [
    {
        path: '/deliver/projet/:id',
        name: 'showProjectDeliver',
        component: DetailProjet,
        props:true
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
    },
    {
        path: '/deliver/mesprojets/rendu/:id',
        name: 'detailsRendu',
        component: DetailsRendu
    }
]
