import VueRouter from 'vue-router';
import GangSheet from './components/pages/GangSheet';

let routes = [
    {
        path: '/gangSheet',
        component: GangSheet
    },
    {
        path: '/',
        redirect: '/gangSheet'
    }
];

export default new VueRouter({
    routes,
    linkActiveClass: 'active'
});