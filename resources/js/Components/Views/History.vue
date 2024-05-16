<script setup>
import {onBeforeMount, ref} from "vue";
import Breadcrumbs from "@/Components/Partials/Breadcrumbs.vue";
import Navbar from "@/Components/Partials/Navbar.vue";
import {useHelpersStore} from "../../Stores/HelpersStore";


const stories = ref()
const helpersStore = useHelpersStore()

onBeforeMount(async () => {
    await getHistory()

    console.log(stories.value)
})
const getHistory = async () => {
    return await axios.get('/api/calculator-history')
        .then((response) => stories.value = response.data.data ?? response.data)
        .catch((error) => console.log(error))
}
</script>

<template>
    <Suspense>
        <Navbar/>
    </Suspense>

    <div class="container mx-auto p-3">
        <breadcrumbs :elements="[{text: 'Истроия', url: '/history'}]"/>


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Дата
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Тип
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="history in stories"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ helpersStore.localizeDateTime(history.created_at) }}
                    </th>
                    <td class="px-6 py-4">
                        {{ history.type === 1 ? 'Калькулятор' : 'Бизнес-калькулятор' }}
                    </td>
                    <td class="px-6 py-4">
                        <router-link v-if="history.type === 1" :to="{ name: 'historyId', params: { id: history.id }}">Перейти</router-link>
                        <router-link v-else :to="{ name: 'BuisnessHistoryId', params: { id: history.id }}">Перейти</router-link>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>

</style>
