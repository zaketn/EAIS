import {createRouter, createWebHistory} from "vue-router";
import Home from "./Components/Views/Home.vue";
import Users from "./Components/Views/Users.vue";
import Tables from "./Components/Views/Tables.vue";
import Statistics from "./Components/Views/Statistics.vue";
import IncomeCalculator from "@/Components/Views/IncomeCalculator.vue";
import IncomeCalculatorSettings from "@/Components/Views/IncomeCalculatorSettings.vue";
import Login from "@/Components/Views/Auth/Login.vue";
import {useAuthStore} from "@/Stores/AuthStore";

const permissions = {
    auth: {
        auth: true
    },
    guest: {
        auth: false
    },
    any: {
        auth: ''
    }
}

const routes = [
    {
        path: '/',
        component: Home,
        meta: {
            permissions: permissions.auth
        },
        name: 'home',
    },
    {
        path: '/login',
        component: Login,
        meta: {
            permissions: permissions.guest
        },
        name: 'login'
    },
    {
        path: '/tables',
        component: Tables,
        meta: {
            permissions: permissions.auth
        },
        name: 'tables',
    },
    {
        path: '/statistics',
        component: Statistics,
        meta: {
            permissions: permissions.auth
        },
        name: 'statistics'
    },
    {
        path: '/users',
        component: Users,
        meta: {
            permissions: permissions.auth
        },
        name: 'users'
    },
    {
        path: '/income-calculator',
        component: IncomeCalculator,
        meta: {
            permissions: permissions.auth
        },
        name: 'incomeCalculator'
    },
    {
        path: '/settings/income-calculator',
        component: IncomeCalculatorSettings,
        meta: {
            permissions: permissions.auth
        },
        name: 'settings.incomeCalculator'
    }
]

export const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach(async (to, from) => {
    const auth = useAuthStore()
    const isAuthenticated = await auth.checkAuth()
    console.log(isAuthenticated)

    if(to.meta.permissions.auth !== ''){
        console.log('permissions is not null')
        if (!isAuthenticated && to.meta.permissions.auth === true) {
            console.log('not auth with auth route')
            return {name: 'login'}
        } else if (isAuthenticated && to.meta.permissions.auth === false) {
            console.info('auth with non auth route')
            return from.path
        }
    }
})
