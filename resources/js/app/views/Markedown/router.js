import Home from './Home.vue';
import ListMarkedDowns from './ListMarkdowns';
import MyMarkedDowns from './ListMarkdowns';
import Archives from './Archives';

export const MarkedownRoutes = [
    {
        path: '/markedowns',
        name: 'MarkedownRoutes',
        component: Home
    },
    {
        path: '/markedowns/list',
        name: 'ListMarkdowns',
        component: ListMarkedDowns
    },
    {
        path: '/markedowns/mymarkedowns',
        name: 'MyMarkdowns',
        component: MyMarkedDowns
    },
    {
        path: '/markedowns/archives',
        name: 'Archives',
        component: Archives
    }
]
