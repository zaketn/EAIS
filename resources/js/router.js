import {createRouter, createWebHistory} from "vue-router";
import {useAuthStore} from "@/Stores/AuthStore";
import {routes} from './routes'

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
