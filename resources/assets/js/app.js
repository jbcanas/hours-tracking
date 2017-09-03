import bootstrap from './bootstrap'
import store from './store'
import router from './routes'

const app = new Vue({
	router,
    el: '#app',
    render: h => h(require('./app.vue')),
    store,
});
