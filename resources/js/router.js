import Tables from "./Components/Views/Tables.vue";
import Statistics from "./Components/Views/Statistics.vue";
import {createRouter, createWebHistory} from "vue-router";
import App from "./Components/App.vue";
import Home from "./Components/Views/Home.vue";

const routes = [
    {
        path: '/',
        component: Home,
        name: 'home',
    },
    {
        path: '/tables',
        component: Tables,
        name: 'tables',
    },
    {
        path: '/statistics',
        component: Statistics,
        name: 'statistics'
    },
]

export const router = createRouter({
    history: createWebHistory(),
    routes
})
