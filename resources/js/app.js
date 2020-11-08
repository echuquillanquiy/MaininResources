require('./bootstrap');

window.Vue = require('vue');
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';


window.Vue.use(ElementUI);

Vue.component('App', require('./components/App.vue').default);

import router from './routes'

const app = new Vue({
    el: '#app',
    router
});
