import VueRouter from 'vue-router';

let routes = [
    {
        path: '/gangSheet',
        component: require('./components/pages/GangSheet')
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