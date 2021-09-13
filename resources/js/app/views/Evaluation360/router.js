import Home from './Home.vue';
import Apprenants from './Dashboard/Dashboard.vue';
import SeeMore from './Dashboard/SeeMore/SeeMore.vue';
import Cohorte from './Formateur/Cohorte.vue';
import Sondage from './Sondages/Sondage.vue';
import GestionSondage from "./Formateur/sondage/GestionSondage.vue";
import SondagesList from './Sondages/SondagesList.vue';
import GestionLearnerSondage from './Sondages/Gestion/GestionLearnerSondage.vue';
import Promotion from './Promotion/Promotion.vue';

export const EvalRoutes = [
    {
        path: '/evaluation360/',
        name: 'eval',
        component: Home,
        meta: { requiresAuth: true, requiresRole: false, roles: [] }
    },
    {
        path: '/evaluation360/apprenants',
        name: 'Apprenants',
        component: Apprenants,
        meta: { requiresAuth: true, requiresRole: false, roles: [] }
    },
    {
        path: '/evaluation360/promotions',
        name: 'Promotions',
        component: Promotion,
        meta: { requiresAuth: true, requiresRole: false, roles: [1,2] }
    },
    {
        path: '/evaluation360/user/:id',
        name: 'SeeMore',
        component: SeeMore,
        meta: { requiresAuth: true, requiresRole: false, roles: [] }
    },
    {
        path: '/evaluation360/cohorte',
        name: 'Cohorte',
        component: Cohorte,
        meta: { requiresAuth: true, requiresRole: true, roles: [1,2] }
    },
    {
        path: '/evaluation360/sondages',
        name: 'SondagesList',
        component: SondagesList,
        meta: { requiresAuth: true, requiresRole: true, roles: [3] }
    },
    {
        path: '/evaluation360/apprenant/sondages',
        name: 'learnerSondage',
        component: GestionLearnerSondage,
        meta: { requiresAuth: true, requiresRole: true, roles: [3] }
    },
    {
        path: '/evaluation360/formateur/sondages',
        name: 'gestionSondage',
        component: GestionSondage,
        meta: { requiresAuth: true, requiresRole: true, roles: [1,2] }
    },
    {
        path: '/evaluation360/Sondage/:userId/:sondageId',
        name: 'Sondage',
        component: Sondage,
        meta: { requiresAuth: true, requiresRole: false, roles: [] }
    },
]
