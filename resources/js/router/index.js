import Vue from 'vue';
import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import Base from '@/Base';

import Index from '@/views/Index';

import Calculation from '@/views/Calculation';
import Ranking from '@views/ranking';
import Demo from '@/views/Demo';
import Register from '@/views/register';

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
                    path: 'calculation',
                    name: 'calculation',
                    component: Calculation,
                },
                {
                    path: 'ranking',
                    name: 'ranking',
                    component: Ranking,
                },
                {
                    path: 'demo',
                    name: 'demo',
                    component: Demo,
                },
                {
                    path: 'register',
                    name: 'register',
                    component: Register,
                },
            ],
        }
    ],
});
