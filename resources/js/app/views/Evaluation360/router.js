import Home from './Home.vue';
import Dashboard from './Dashboard/Dashboard.vue';
import SeeMore from './Dashboard/SeeMore/SeeMore.vue';
import Cohorte from './Formateur/Cohorte.vue';
import VerifyMail from '../../views/VerifyMail.vue';
import Sondage from './Sondages/Sondage.vue';
import GestionSondage from "./Formateur/sondage/GestionSondage.vue";

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
    {
        path: '/evaluation360/Sondage',
        name: 'Sondage',
        component: Sondage
    },
    {
        path: '/evaluation360/gestion/sondages',
        name: 'gestionSondage',
        component: GestionSondage
    },
]