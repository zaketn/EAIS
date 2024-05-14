import Home from "./Components/Views/Home.vue";
import History from "./Components/Views/History.vue";
import Tables from "./Components/Views/Tables.vue";
import Statistics from "./Components/Views/Statistics.vue";
import GovernmentSupport from "./Components/Views/GovernmentSupport.vue";
import AiRecommendations from "./Components/Views/AiRecommendations.vue";
import {permissions} from "./permissions";
import IncomeCalculator from "./Components/Views/IncomeCalculator.vue";
import Registration from "./Components/Views/Auth/Registration.vue";
import BuisnessCalculator from "./Components/Views/BuisnessCalculator.vue";
import Login from "./Components/Views/Auth/Login.vue";

export const routes = [
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
        path: '/income-calculator',
        component: IncomeCalculator,
        meta: {
            permissions: permissions.auth
        },
        name: 'incomeCalculator'
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
