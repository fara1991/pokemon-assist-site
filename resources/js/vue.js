import Vue from 'vue';
import Vuex from 'vuex';
import App from './Main';
import router from './router';

Vue.use(Vuex);

new Vue ({
    el: '#app',
    router,
    template: '<App/>',
    components: {
        App
    }
})
