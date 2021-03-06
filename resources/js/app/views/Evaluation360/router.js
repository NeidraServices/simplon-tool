import Home from './Home.vue';
import Apprenants from './Dashboard/Dashboard.vue';
import SeeMore from './Dashboard/SeeMore/SeeMore.vue';
import Cohorte from './Formateur/Cohorte.vue';
import Sondage from './Sondages/Sondage.vue';
import GestionSondage from "./Formateur/sondage/GestionSondage.vue";
import SondagesList from './Sondages/SondagesList.vue';

export const EvalRoutes = [
    {
        path: '/evaluation360',
        name: 'eval',
        component: Home
    },
    {
        path: '/apprenants',
        name: 'Apprenants',
        component: Apprenants
    },
    {
        path: '/user/:id',
        name: 'SeeMore',
        component: SeeMore
    },
    {
        path: '/evaluation360/Cohorte',
        name: 'Cohorte',
        component: Cohorte
    },
    {
        path: '/evaluation360/Sondages',
        name: 'SondagesList',
        component: SondagesList
    },
    {
        path: '/evaluation360/Sondage/:userId/:sondageId',
        name: 'Sondage',
        component: Sondage
    },
    {
        path: '/evaluation360/gestion/sondages',
        name: 'gestionSondage',
        component: GestionSondage
    },
]