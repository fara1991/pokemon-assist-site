import Vue from 'vue';
import Router from 'vue-router';

import Full from '@/Full';
// Components
// import Components from '@/components/';

// Complete
// import Complete from '@/views/complete/';

// Calculation
// import Calculation from '@/views/calculation/';

import Index from '@/views/Index';

Vue.use(Router);

export default new Router({
    mode: 'hash',
    linkActiveClass: 'open active',
    scrollBehavior: () => ({y: 0}),
    routes: [
        {
            path: '/',
            redirect: '/index',
            name: 'Index',
            component: Full,
            children: [
                {
                    path: 'index',
                    name: 'index',
                    component: Index,
                }
            ],
        }
    ],
});
