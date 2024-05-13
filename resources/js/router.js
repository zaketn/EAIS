import {createRouter, createWebHistory} from "vue-router";
import Home from "./Components/Views/Home.vue";
import Users from "./Components/Views/Users.vue";
import Tables from "./Components/Views/Tables.vue";
import Statistics from "./Components/Views/Statistics.vue";
import IncomeCalculator from "@/Components/Views/IncomeCalculator.vue";
import IncomeCalculatorSettings from "@/Components/Views/IncomeCalculatorSettings.vue";
import Login from "@/Components/Views/Auth/Login.vue";
import {useAuthStore} from "@/Stores/AuthStore";
import History from "@/Components/Views/History.vue";
import Registration from "@/Components/Views/Auth/Registration.vue";
import BuisnessCalculator from "@/Components/Views/BuisnessCalculator.vue";
import GovernmentSupport from "./Components/Views/GovernmentSupport.vue";
import AiRecommendations from "./Components/Views/AiRecommendations.vue";

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
    },
    {
        path: '/history/:id',
        component: IncomeCalculator,
        meta: {
            permissions: permissions.auth
        },
        name: 'historyId'
    },
    {
        path: '/history',
        component: History,
        meta: {
            permissions: permissions.auth
        },
        name: 'history'
    },
    {
        path: '/registration',
        component: Registration,
        meta: {
            permissions: permissions.guest
        },
        name: 'registration'
    },
    {
        path: '/buisness-calculator',
        component: BuisnessCalculator,
        meta: {
            permissions: permissions.auth
        },
        name: 'buisnessCalculator'
    },
    {
        path: '/government-support',
        component: GovernmentSupport,
        meta: {
            permissions: permissions.auth
        },
        name: 'governmentSupport'
    },
    {
        path: '/ai-recommendations',
        component: AiRecommendations,
        meta: {
            permissions: permissions.auth
        },
        name: 'aiRecommendations'
    }
]

export const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach(async (to, from) => {
    const auth = useAuthStore()
    const isAuthenticated = await auth.checkAuth()

    if(to.meta.permissions.auth !== ''){
        if (!isAuthenticated && to.meta.permissions.auth === true) {
            return {name: 'login'}
        } else if (isAuthenticated && to.meta.permissions.auth === false) {
            return from.path
        }
    }
})
