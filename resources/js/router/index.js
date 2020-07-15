import Vue from 'vue';
import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import swshIndex from '@/views/swsh/index';
import swshCalculationIndex from '@/views/swsh/calculation/index';
import swshCalculationDetail from '@/views/swsh/calculation/detail';
import swshRankingIndex from '@/views/swsh/ranking/index';
import swshDemoIndex from '@/views/swsh/demo/index';
import swshRegisterIndex from '@/views/swsh/register/index';

import NotFound from '@/views/error/404';

Vue.use(VueRouter);
Vue.use(BootstrapVue);

const routeList = [
    {
        path: '',
        redirect: '/swsh', // 最新世代にしておく
        component: {
            render(c) {
                return c('router-view');
            }
        },
        children: [
            {
                path: 'swsh',
                redirect: '/swsh/index',
                component: {
                    render(c) {
                        return c('router-view');
                    }
                },
                children: [
                    {
                        path: 'index',
                        name: 'index',
                        component: swshIndex,
                    },
                    {
                        path: 'calculation',
                        name: 'calculation',
                        component: {
                            render(c) {
                                return c('router-view');
                            }
                        },
                        children: [
                            {
                                path: 'index',
                                name: 'calculationIndex',
                                component: swshCalculationIndex,
                            },
                            {
                                path: 'detail',
                                name: 'calculationDetail',
                                component: swshCalculationDetail,
                            }
                        ]
                    },
                    {
                        path: 'ranking',
                        name: 'ranking',
                        component: {
                            render(c) {
                                return c('router-view');
                            }
                        },
                        children: [
                            {
                                path: 'index',
                                name: 'rankingIndex',
                                component: swshRankingIndex,
                            }
                        ]
                    },
                    {
                        path: 'demo',
                        name: 'demo',
                        component: {
                            render(c) {
                                return c('router-view');
                            }
                        },
                        children: [
                            {
                                path: 'index',
                                name: 'demoIndex',
                                component: swshDemoIndex,
                            }
                        ]
                    },
                    {
                        path: 'register',
                        name: 'register',
                        component: {
                            render(c) {
                                return c('router-view');
                            }
                        },
                        children: [
                            {
                                path: 'index',
                                name: 'registerIndex',
                                component: swshRegisterIndex,
                            },
                        ],
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
