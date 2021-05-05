import Home from './Home.vue';
import ListMarkedDowns from './ListMarkdowns';
import MyMarkedDowns from './MyMarkdowns';
import Archives from './Archives';
import AddMarkdown from "./AddMarkdown";
import ShowEditMd from "./ShowEditMd";

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
    },
]
