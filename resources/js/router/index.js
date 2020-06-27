import Vue from 'vue';
import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import Base from '@/Base';
// Components
// import Components from '@/components/';

// Complete
// import Complete from '@/views/complete/';

// Calculation
// import Calc from '@/views/calc/';

import Index from '@/views/Index';

Vue.use(VueRouter);
Vue.use(BootstrapVue);

export default new VueRouter({
    scrollBehavior: () => ({y: 0}),
    routes: [
        {
            path: '/',
            redirect: '/index',
            component: Base,
            children: [
                {
                    path: 'index',
                    name: 'index',
                    component: Index,
                },
                {
                    path: 'culc',
                    name: 'culc',
                    component: Culc,
                }
            ],
        }
    ],
});
