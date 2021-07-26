import Home from './Home.vue';
import Apprenants from './Dashboard/Dashboard.vue';
import SeeMore from './Dashboard/SeeMore/SeeMore.vue';
import Cohorte from './Formateur/Cohorte.vue';
import Sondage from './Sondages/Sondage.vue';
import GestionSondage from "./Formateur/sondage/GestionSondage.vue";
import SondagesList from './Sondages/SondagesList.vue';
import GestionLearnerSondage from './Sondages/Gestion/GestionLearnerSondage.vue';

export const EvalRoutes = [
    {
        path: '/evaluation360',
        name: 'eval',
        component: Home
    },
    {
        path: '/evaluation360/apprenants',
        name: 'Apprenants',
        component: Apprenants
    },
    {
        path: '/user/:id',
        name: 'SeeMore',
        component: SeeMore
    },
    {
        path: '/evaluation360/cohorte',
        name: 'Cohorte',
        component: Cohorte
    },
    {
        path: '/evaluation360/sondages',
        name: 'SondagesList',
        component: SondagesList
    }, 
    {
        path: '/evaluation360/apprenant/sondages',
        name: 'learnerSondage',
        component: GestionLearnerSondage
    },
    {
        path: '/evaluation360/formateur/sondages',
        name: 'gestionSondage',
        component: GestionSondage
    },
    {
        path: '/evaluation360/Sondage/:userId/:sondageId',
        name: 'Sondage',
        component: Sondage
    },
]