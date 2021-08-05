window.Vue = require('vue');
window.axios = require('axios');

import 'font-awesome/css/font-awesome.css';
import './app.scss';

import AppApi from './plugins/app-api.plugin.js';
import router from './router';
import store from './app.store';
import appMessage from './components/app-message/app-message.vue';
import validatedInput from './components/validated-input/validated-input.vue';
import LoadingSpinner from './components/loading-spinner/loading-spinner.vue';
import BootstrapVue from 'bootstrap-vue';
import authorizedLayout from './components/authorized-layout/authorized-layout.vue';
import { dateFilter } from './filters/date.filter.js';

Vue.use(AppApi);
Vue.use(BootstrapVue);

Vue.component('app-message', appMessage);
Vue.component('validated-input', validatedInput);
Vue.component('loading-spinner', LoadingSpinner);
Vue.component('authorized-layout', authorizedLayout);

Vue.filter('date', dateFilter);

const app = new Vue({
    el: '#vueApp',
    router,
    store,
    components: {}
});
