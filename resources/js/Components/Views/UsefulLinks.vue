<script setup>
import { onBeforeMount, ref, watchEffect } from "vue";
import axios from "axios";
import Breadcrumbs from "@/Components/Partials/Breadcrumbs.vue";
import Navbar from "@/Components/Partials/Navbar.vue";

const stories = ref([]);
const searchTerm = ref('');

onBeforeMount(async () => {
    await getLinks();
});

const getLinks = async () => {
    try {
        const response = await axios.get('/api/useful-links');
        stories.value = response.data.data ?? response.data;
    } catch (error) {
        console.error(error);
    }
};

// Реактивное вычисляемое свойство для отфильтрованных данных
const filteredStories = ref([]);

watchEffect(() => {
    filteredStories.value = stories.value.filter(link => link.name.toLowerCase().includes(searchTerm.value.toLowerCase()));
});

</script>

<template>
    <Suspense>
        <Navbar/>
    </Suspense>

    <div class="container mx-auto p-3">
        <Breadcrumbs :elements="[{text: 'Полезные ссылки', url: '/history'}]"/>

        <!-- Строка поиска -->
        <div class="mb-3">
            <input type="text" v-model="searchTerm" class="px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500 w-full" placeholder="Поиск по названию">
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Название
                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="link in filteredStories" :key="link.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ link.name }}
                    </th>
                    <td class="px-6 py-4">
                        <a :href="link.url" target="_blank" rel="noreferrer noopener" class="text-blue-500 dark:text-blue-400">Перейти</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>
/* ваш стиль для таблицы */
</style>
