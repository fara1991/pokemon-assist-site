import Vue from 'vue';
import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';
import VueBreadcrumbs from 'vue-2-breadcrumbs';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import swshIndex from '@/views/swsh/index';
import swshCalculationIndex from '@/views/swsh/calculation/index';
import swshCalculationDetail from '@/views/swsh/calculation/detail';
import swshRankingIndex from '@/views/swsh/ranking/index';
import swshDemoIndex from '@/views/swsh/demo/index';
import swshRegisterIndex from '@/views/swsh/register/index';

import notFound from '@/views/error/notFound';

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(VueBreadcrumbs);

const routeList = [
    {
        path: '',
        redirect: '/swsh', // 最新世代にしておく
        meta: {
            breadcrumb: {
                label: 'Home',
            }
        },
        component: {
            render(c) {
                return c('router-view');
            }
        },
        children: [
            {
                path: 'swsh',
                redirect: '/swsh/index',
                meta: {
                    breadcrumb: {
                        parent: 'Home',
                        label: 'ソード・シールド',
                    },
                },
                component: {
                    render(c) {
                        return c('router-view');
                    }
                },
                children: [
                    {
                        path: 'index',
                        name: 'index',
                        meta: {
                            breadcrumb: {
                                parent: 'ソード・シールド',
                                label: 'TOP',
                            },
                        },
                        component: swshIndex,
                    },
                    {
                        path: 'calculation',
                        name: 'calculation',
                        redirect: '/swsh/calculation/index',
                        meta: {
                            breadcrumb: {
                                parent: 'ソード・シールド',
                                label: 'ステータス計算',
                            }
                        },
                        component: {
                            render(c) {
                                return c('router-view');
                            }
                        },
                        children: [
                            {
                                path: 'index',
                                name: 'calculationIndex',
                                meta: {
                                    breadcrumb: {
                                        parent: 'ステータス計算',
                                        label: '検索・一覧',
                                    }
                                },
                                component: swshCalculationIndex,
                            },
                            {
                                path: 'detail',
                                name: 'calculationDetail',
                                meta: {
                                    breadcrumb: {
                                        parent: 'ステータス計算',
                                        label: '詳細',
                                    }
                                },
                                component: swshCalculationDetail,
                            }
                        ]
                    },
                    {
                        path: 'ranking',
                        name: 'ranking',
                        redirect: '/swsh/ranking/index',
                        meta: {
                            breadcrumb: {
                                parent: 'ソード・シールド',
                                label: 'ランキング',
                            }
                        },
                        component: {
                            render(c) {
                                return c('router-view');
                            }
                        },
                        children: [
                            {
                                path: 'index',
                                name: 'rankingIndex',
                                meta: {
                                    breadcrumb: {
                                        parent: 'ランキング',
                                        label: '各種ランキング',
                                    }
                                },
                                component: swshRankingIndex,
                            }
                        ]
                    },
                    {
                        path: 'demo',
                        name: 'demo',
                        redirect: '/swsh/demo/index',
                        meta: {
                            breadcrumb: {
                                parent: 'ソード・シールド',
                                label: '戦闘デモ',
                            }
                        },
                        component: {
                            render(c) {
                                return c('router-view');
                            }
                        },
                        children: [
                            {
                                path: 'index',
                                name: 'demoIndex',
                                meta: {
                                    breadcrumb: {
                                        parent: '戦闘デモ',
                                        label: 'テスト',
                                    }
                                },
                                component: swshDemoIndex,
                            }
                        ]
                    },
                    {
                        path: 'register',
                        name: 'register',
                        redirect: '/swsh/register/index',
                        meta: {
                            breadcrumb: {
                                parent: 'ソード・シールド',
                                label: 'PT登録',
                            }
                        },
                        component: {
                            render(c) {
                                return c('router-view');
                            }
                        },
                        children: [
                            {
                                path: 'index',
                                name: 'registerIndex',
                                meta: {
                                    breadcrumb: {
                                        parent: 'PT登録',
                                        label: 'ポケモン選択',
                                    }
                                },
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
        component: notFound,
    },
];

export default new VueRouter({
    scrollBehavior: () => ({y: 0}),
    routes: routeList,
});
