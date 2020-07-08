import Vue from 'vue';
import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import Base from '@/Base';

// Sword&Shield
import SwshIndex from '@/views/swsh/Index';
import SwshCalculation from '@/views/swsh/Calculation';
import SwshRanking from '@/views/swsh/Ranking';
import SwshDemo from '@/views/swsh/Demo';
import SwshRegister from '@/views/swsh/Register';

import NotFound from '@/views/error/404';

Vue.use(VueRouter);
Vue.use(BootstrapVue);

const routeList = [
    {
        path: '/',
        redirect: '/swsh', // 最新世代にしておく
        component: Base,
        children: [
            {
                path: 'swsh',
                redirect: '/swsh/index',
                component: Base, //後々Swsh用の書き込みが必要なら別途ページを用意する
                children: [
                    {
                        path: 'index',
                        name: 'index',
                        component: SwshIndex,
                    },
                    {
                        path: 'calculation',
                        name: 'calculation',
                        component: SwshCalculation,
                    },
                    {
                        path: 'ranking',
                        name: 'ranking',
                        component: SwshRanking,
                    },
                    {
                        path: 'demo',
                        name: 'demo',
                        component: SwshDemo,
                    },
                    {
                        path: 'register',
                        name: 'register',
                        component: SwshRegister,
                    },
                ],
            },
        ],
    },
    {
        path: '*',
        name: 'NotFound',
        component: NotFound,
    },
];

export default new VueRouter({
    scrollBehavior: () => ({y: 0}),
    routes: routeList,
});
