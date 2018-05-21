import Vue from 'vue';
import bootstrap from './bootstrap';
import store from './store';
import router from './routes';
import App from './App';
import BootstrapVue from 'bootstrap-vue';

Vue.use(BootstrapVue);

new Vue({
    router,
    el: '#app',
    components: { App },
    template: '<App/>',
    store,
});
