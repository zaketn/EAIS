import {defineStore} from "pinia";
import {ref} from "vue";

export const useAuthStore = defineStore('authStore', () => {
    const user = ref()

    async function login(email, password) {
        let loginData

        await axios.get('/sanctum/csrf-cookie')
            .then(async () => {
                return await axios.post('/login', {
                    email: email,
                    password: password
                })
                    .then((response) => {
                        loginData = response.status
                    })
                    .catch((error) => console.log(error))
            })

        return loginData
    }

    function logout() {
        return axios.get('/sanctum/csrf-cookie').then(() => {
            axios.post('/logout')
                .then(async (response) => {
                    if (response.status === 204) {
                        window.location.replace("/login");
                    }
                })
                .catch((error) => console.log(error))
        })
    }

    async function checkAuth() {
        let isAuthenticated

        await axios.get('/sanctum/csrf-cookie')
            .then(async () => {
                await axios.post('/check-auth')
                    .then((response) => {
                        isAuthenticated = Boolean(response.data)
                    })
                    .catch((error) => console.log(error))
            })

        return isAuthenticated
    }

    async function register(email, password, name, password_confirmation) {
        let registerData;

        await axios.get('/sanctum/csrf-cookie')
            .then(async () => {
                return await axios.post('/register', {
                    name: name,
                    email: email,
                    password: password,
                    password_confirmation: password_confirmation
                })
                    .then((response) => {
                        registerData = response.status;
                    })
                    .catch((error) => console.log(error));
            });

        return registerData;
    }

    return {user, login, checkAuth, logout, register}
})
