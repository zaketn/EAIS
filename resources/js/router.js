import {createRouter, createWebHistory} from "vue-router";
import Home from "./Components/Views/Home.vue";
import Users from "./Components/Views/Users.vue";
import Tables from "./Components/Views/Tables.vue";
import Statistics from "./Components/Views/Statistics.vue";
import IncomeCalculator from "@/Components/Views/IncomeCalculator.vue";
import IncomeCalculatorSettings from "@/Components/Views/IncomeCalculatorSettings.vue";

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
    {
        path: '/users',
        component: Users,
        name: 'users'
    },
    {
        path: '/income-calculator',
        component: IncomeCalculator,
        name: 'income-calculator'
    },
    {
        path: '/settings/income-calculator',
        component: IncomeCalculatorSettings,
        name: 'settings.income-calculator'
    }
]

export const router = createRouter({
    history: createWebHistory(),
    routes
})
