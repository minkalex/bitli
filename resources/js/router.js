import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    routes: [
        { path: '/links', component: () => import('./components/Link/Index'), name: 'links.index' },
        { path: '/', component: () => import('./components/Link/Create'), name: 'links.create' },
    ]
})
