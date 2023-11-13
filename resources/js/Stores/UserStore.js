import {defineStore} from "pinia";

export const useUserStore = defineStore('userStore', () => {
    async function getUser() {
        let user

        await axios.get('/sanctum/csrf-cookie')
            .then(async () => {
                await axios.get('/api/user')
                    .then((response) => {
                        user = response.data
                    })
                    .catch(() => null)
            })

        return user
    }

    return {getUser}
})
