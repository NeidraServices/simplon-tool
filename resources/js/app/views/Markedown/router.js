import Home from './Home.vue';
import ListMarkedDowns from './ListMarkdowns';
import MyMarkedDowns from './MyMarkdowns';
import Archives from './Archives';
import AddMarkdown from "./AddMarkdown";
import ShowEditMd from "./ShowEditMd";
import ShowReadMd from "./ShowReadMd";

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
        path: '/markedowns/archives/:id?',
        name: 'Archives',
        component: Archives,
        props:true
    },
    {
        path: '/markedowns/add',
        name: 'AddMarkdowns',
        component: AddMarkdown
    },
    {
        path: '/markedowns/show-edit-md/:id',
        name: 'ShowEditMd',
        component: ShowEditMd,
        props:true
    }, {
        path: '/markedowns/show-read-md/:id',
        name: 'ShowReadMd',
        component: ShowReadMd,
        props:true
    },
]
