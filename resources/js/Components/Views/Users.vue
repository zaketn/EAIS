<script setup>
import Breadcrumbs from "../Partials/Breadcrumbs.vue";
import Navbar from "@/Components/Partials/Navbar.vue";
import {onBeforeMount, ref} from "vue";

const roles = ref()
const users = ref()

onBeforeMount(async () => {
    await getUsers()
    await getRoles()

    console.log(users.value)
})
const getUsers = async () => {
    return await axios.get('/api/users')
        .then((response) => users.value = response.data.data ?? response.data)
        .catch((error) => console.log(error))
}

const getRoles = async () => {
    return await axios.get('api/roles')
        .then((response) => roles.value = response.data.data ?? response.data)
        .catch((error) => console.log(error))
}

const updateRole = (event) => {
    axios.post('/api/users/update-role', {
        userId: event.target.dataset.userId,
        roleId: event.target.value
    })
        .then((response) => console.log(response))
        .catch((error) => console.log(error))
}


</script>

<template>
    <Suspense>
        <Navbar />
    </Suspense>

    <div class="container mx-auto p-3">
        <breadcrumbs :elements="[{text: 'Пользователи', url: '/users'}]"/>


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Имя
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Электронная почта
                    </th>
                    <th scope="col" class="px-6 py-3 text-right">
                        Права
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ user.name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ user.email }}
                    </td>
                    <td class="px-6 py-4">
                        <select
                            @change="updateRole"
                            :data-user-id="user.id"
                            class="ml-auto rounded-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-fit min-w-fit p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option :selected="user.role === null || user.role === undefined" disabled>Права не назначены
                            </option>
                            <option
                                :selected="user.role ? user.role.id === role.id : false"
                                v-for="role in roles"
                                :value="role.id">
                                {{ role.name }}
                            </option>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>

</style>
