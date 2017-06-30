import VueRouter from 'vue-router';

let routes = [
    {
        path: '/gangSheet',
        component: require('./components/pages/GangSheet')
    }
];

export default new VueRouter({
    routes,
    linkActiveClass: 'active'
});